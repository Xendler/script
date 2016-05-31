<!doctype html>
<html class="no-js" lang="{{ Config::get('languages')[App::getLocale()] }}"> 
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ $title }}VENTUREFAST</title>
    <meta name="keywords" content="csgo джекпот,csgo jackpot, рулетка csgo,fast рулетка,игры на скины csgo,игра на депозит," />
    <meta name="description" content="VENTUREFAST - Умножь свои скины CS:GO" />
       
    <meta name="csrf-token" content="{!!  csrf_token()   !!}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}"/>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/loot.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/chat.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
    <script src="{{ asset('assets/js/main.js') }}" ></script>
    <script src="{{ asset('assets/js/vendor.js') }}" ></script>
    <script src="{{ asset('assets/js/moment.min.js') }}" ></script>
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <script>
    @if(!Auth::guest())
		var avatar = '{{ $u->avatar }}';
        const USER_ID = '{{ $u->steamid64 }}';
    @else
        const USER_ID = 'null';
    @endif
        const LANG = '{{ Config::get('languages')[App::getLocale()] }}';
		const KURS = 64;
        var START = true;
    </script>
</head>
<body>				    
    <audio id="newBet" src="{{ asset('assets/sounds/newBet.ogg') }}" preload="auto"></audio>
    <audio id="scrollSlider" src="{{ asset('assets/sounds/cykcyk.wav') }}" preload="auto"></audio>
	<audio id="newGame" src="{{ asset('assets/sounds/start-game.mp3') }}" preload="auto"></audio>
<div class="main-container">
        <div class="dad-container">
            <header>
    <div class="header-container">
        <div class="header-top">
            <div class="logotype active">
                <a href="/"><img src="{{ asset('assets/img/logo-ru.png') }}"></a>
                    <div class="langs clr-b">
					<a href="/lang/ru" title="<?php echo trans('menu.ru'); ?>"><img src="{{ asset('assets/images/lang_ru.png') }}" alt=""></a>
					<a href="/lang/en" title="<?php echo trans('menu.en'); ?>"><img src="{{ asset('assets/images/lang_en.png') }}" alt=""></a>
                   </div> 
                  </div>
            <div class="header-menu">
                <ul id="headNav" class="list-reset">
                    <li class="top"><a href="{{ route('top') }}"><?php echo trans('menu.topplayer'); ?></a></li>
                    <li class="history"><a href="{{ route('history') }}"><?php echo trans('menu.historygame'); ?></a></li>
                    <li class="about"><a href="{{ route('about') }}"> <?php echo trans('menu.about'); ?> </a></li>
                    <li class="faq"><a href="{{ route('support') }}"> <?php echo trans('menu.support'); ?> </a></li>
                    <li class="fairplay"><a href="{{ route('fairplay') }}"> <?php echo trans('menu.fairplay'); ?> </a></li>                    
                    <li class="magazine last"><a href="{{ route('cards') }}"> <?php echo trans('menu.shopskins'); ?> </a></li>
                </ul>
            </div>
        </div>

        <div class="header-bottom">
            <div class="left-block">
                <div class="information-block">
                    <ul class="list-reset">
                        <li><span class="stats-onlineNow">0</span><?php echo trans('menu.onlinesechas'); ?></li>
                        <li><span>{{ \App\Game::gamesToday() }}</span><?php echo trans('menu.gametuday'); ?></li>
                        <li><span>{{ \App\Game::maxPrice() }}</span><?php echo trans('menu.maxprice'); ?></li>
                        <li class="max-bank">
                            <a href="/game/{{ \App\Game::lastGame() }}">
                                <span>{{ \App\Game::lastGame() }}</span><?php echo trans('menu.lastgame'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="right-block">
            @if(Auth::guest())
                <div class="profile">
                    <a href="{{ route('login') }}" class="authorization"> <?php echo trans('menu.authorization'); ?> </a>
                </div>
            @else
            <div class="profile">
                   <div class="profile-block">
                        <div class="user-avatar">
                            <img src="{{ $u->avatar }}">
                        </div>
                        <div class="profile-wrap-block">
                            <div class="profile-head">
                                <div class="user-login">{{ $u->username }}</div>
                                <a href="{{ route('logout') }}" class="exit"> <?php echo trans('menu.exit'); ?> </a>
                            </div>

                            <div class="profile-footer">
                                <ul class="list-reset">
                                    <li><a href="/user/{{ $u->steamid64 }}"> <?php echo trans('menu.myprofile'); ?> </a></li>
                                    <li><a href="{{ route('my-history') }}"> <?php echo trans('menu.mygame'); ?> </a></li>
                                    <li><a href="{{ route('my-inventory') }}"> <?php echo trans('menu.inventory'); ?> </a></li>
                                </ul>
                         </div>
                       </div>
                    </div>
                  </div>
               @endif
                </div>                   

        </div>
    </div>
</header>
<main>
     <div class="content-block">
            @yield('content')
    </main>
  </div>
</body>
</div>

<script src="{{ asset('assets/js/appjs.js') }}" ></script>

<script>
    @if(!Auth::guest())
    function updateBalance() {
        $.post('{{route('get.balance')}}', function (data) {
            $('.userBalance').text(data);
        });
    }
    function addTicket(id, btn){
        $.post('{{route('add.ticket')}}',{id:id}, function(data){
            updateBalance();
            return $.notify(data.text, data.type);
        });
    }
    @endif
                      
</script>
</html>
