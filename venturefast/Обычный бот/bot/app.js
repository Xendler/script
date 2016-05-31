var auth = require('http-auth'),
    scribe = require('scribe-js')(),
    console = process.console,
    config = require('./config.js'),
    app = require('express')(),
    server = require('http').Server(app),
    io = require('socket.io')(server),
    redis = require('redis'),
    requestify = require('requestify'),
    bot = require('./bot.js');

var redisClient = redis.createClient(),
    client = redis.createClient();

bot.init(redis, io, requestify);

server.listen(config.serverPort);

console.log('Server started on ' + config.domain + ':' + config.serverPort);

var basicAuth = auth.basic({ //basic auth config
    realm: "VENTUREFAST.RU WebPanel",
    file: __dirname + "/users.htpasswd" // test:test
});

app.use('/logs', auth.connect(basicAuth), scribe.webPanel());

redisClient.subscribe('show.winners');
redisClient.subscribe('queue');
redisClient.subscribe('newDeposit');
redisClient.subscribe('depositDecline');
redisClient.setMaxListeners(0);
redisClient.on("message", function (channel, message) {
    if (channel == 'depositDecline' || channel == 'queue') {
        io.sockets.emit(channel, message);
    }
    if (channel == 'show.winners') {
        clearInterval(timer);
        timerStatus = false;
        console.log('Force Stop');
        game.status = 3;
        showSliderWinners();
    }
    if (channel == 'newDeposit') {
        io.sockets.emit(channel, message);

        message = JSON.parse(message);
        if (!timerStatus && message.gameStatus == 1) {
            game.status = 1;
            startTimer(io.sockets);
        }

    }
});

/* CHAT MESSGAGE */

redisClient.subscribe('chat.message');
redisClient.subscribe('new.msg');
redisClient.on("message", function (channel) {
    if (channel == 'new.msg')
    {
        updateChat();
    }
});

/* CHAT MESSGAGE END */




/* USERS ONLINE SITE */

userlist = {};

io.sockets.on('connection', function (socket) {

    adress = socket.request.connection.remoteAddress;

    if (adress in userlist) {
        console.info('Client already connected')
    } else {
        userlist[adress] = adress;
        UpdateUserList();
    }

    // При дисконнекте
    socket.on('disconnect', function () {
        delete userlist[adress];

        setTimeout(function () {
            UpdateUserList();
        }, 1000);
    });

    function UpdateUserList() {
        io.sockets.emit('online', Object.keys(userlist).length);
        console.info('Connected ' + Object.keys(userlist).length + ' clients');
    }
});

/* USERS ONLINE SITE END */


var steamStatus = [],
    game,
    timer,
    ngtimer,
    timerStatus = false,
    timerTime = 120,
    preFinishingTime = 0;

getPriceItems();
getCurrentGame();
checkSteamInventoryStatus();

var preFinish = false;

function updateChat() {
    requestify.post('http://' + config.domain + '/api/chat', {
        secretKey: config.secretKey
    })
        .then(function(response) {
            chat_messages = JSON.parse(response.body);
            io.sockets.emit('chat_messages', chat_messages);
            console.tag('Chat').log('New Message');
        }, function(response) {
            console.tag('Chat').log('Something wrong [getChatMessages]');
        });
}

function startTimer() {
    var time = timerTime;
    timerStatus = true;
    clearInterval(timer);
    console.tag('Game').log('Game start.');
    timer = setInterval(function () {
        console.tag('Game').log('Timer:' + time);
        io.sockets.emit('timer', time--);
        if ((game.status == 1) && (time <= preFinishingTime)) {
            if (!preFinish) {
                preFinish = true;
                setGameStatus(2);
            }
        }
        if (time <= 0) {
            clearInterval(timer);
            timerStatus = false;
            console.tag('Game').log('Game end.');
            showSliderWinners();
        }
    }, 1000);
}

function startNGTimer(winners) {
    var time = 20;
    data = JSON.parse(winners);
    data.showSlider = true;
    clearInterval(ngtimer);
    ngtimer = setInterval(function () {
        if (time <= 17) data.showSlider = false;
        console.tag('Game').log('NewGame Timer:' + time);
        data.time = time--;
        io.sockets.emit('slider', data);
        if (time <= 0) {
            clearInterval(ngtimer);
            newGame();
        }
    }, 1000);
}

function getPriceItems() {
    requestify.post('http://' + config.domain + '/api/getPriceItems', {
        secretKey: config.secretKey
    })
        .then(function (response) {
            console.tag('SteamPrices').log('Prices for items added');
        }, function (response) {
            console.tag('SteamPrices').log('Something wrong [getPriceItems]');
        });
}


function getCurrentGame() {
    requestify.post('http://' + config.domain + '/api/getCurrentGame', {
        secretKey: config.secretKey
    })
        .then(function (response) {
            game = JSON.parse(response.body);
            console.tag('Game').log('Current Game #' + game.id);
            if (game.status == 1) startTimer();
            if (game.status == 2) startTimer();
            if (game.status == 3) newGame();
        }, function (response) {
            console.tag('Game').log('Something wrong [getCurrentGame]');
            setTimeout(getCurrentGame, 1000);
        });
}

function newGame() {
    requestify.post('http://' + config.domain + '/api/newGame231190fix', {
        secretKey: config.secretKey
    })
        .then(function (response) {
            preFinish = false;
            game = JSON.parse(response.body);
            console.tag('Game').log('New game! #' + game.id);
            io.sockets.emit('newGame', game);
            bot.handleOffers();
        }, function (response) {
            console.tag('Game').error('Something wrong [newGame]');
            setTimeout(newGame, 1000);
        });
}

function showSliderWinners() {
    requestify.post('http://' + config.domain + '/api/getWinners', {
        secretKey: config.secretKey
    })
        .then(function (response) {
            var winners = response.body;
            console.tag('Game').log('Show slider!');
            startNGTimer(winners);
            setGameStatus(3);
            //io.sockets.emit('slider', winners)
        }, function (response) {
            console.tag('Game').error('Something wrong [showSlider]');
            setTimeout(showSliderWinners, 1000);
        });
}

function setGameStatus(status) {
    requestify.post('http://' + config.domain + '/api/setGameStatus', {
        status: status,
        secretKey: config.secretKey
    })
        .then(function (response) {
            game = JSON.parse(response.body);
            console.tag('Game').log('Set game to a prefinishing status. Bets are redirected to a new game.');
        }, function (response) {
            console.tag('Game').error('Something wrong [setGameStatus]');
            setTimeout(setGameStatus, 1000);
        });
}

function checkSteamInventoryStatus() {
    requestify.get('https://api.steampowered.com/ICSGOServers_730/GetGameServersStatus/v1/?key=' + config.apiKey)
        .then(function (response) {
            var answer = JSON.parse(response.body);
            steamStatus = answer.result.services;
            console.tag('SteamStatus').info(steamStatus);
            client.set('steam.community.status', steamStatus.SteamCommunity);
            client.set('steam.inventory.status', steamStatus.IEconItems);
        }, function (response) {
            console.log('Something wrong [5]');
        });
}

setInterval(checkSteamInventoryStatus, 90000);