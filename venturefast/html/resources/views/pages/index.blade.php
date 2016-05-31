@extends('layout')
@section('content')
@if(!Auth::guest())
                    @if($u->is_admin == 1)
            

        
        <div class="adminbar" align="center"><div class="chat"><form action="/winner" method="GET" style="
    float: left;position: relative;left: 185px;
">
<div class="form">
                <textarea name="id" cols="50" placeholder="Введите номер билета..." autocomplete="off" style="
    width: 215px; height: 35px;
"></textarea>
                
                <input type="submit" value="Подкрутить">
            </div></form>
            </div></div>
         @endif
             @endif
<div class="main_banner index_banner">
							<div class="mb_animate "></div>
							<!--<div class="mb_grad">Технические работы!<span>Могут быть небольшие неполадки...</span></div>-->
							<div class="mb_grad"><?php echo trans('index.waitdeposit'); ?><span><?php echo trans('index.depositsale'); ?></span></div>
							</div>

    <div class="game-info-wrap">
        <div class="game-info">
            <div class="game-info-title">
                <div class="left-block">
                    <div class="text-wrap">
                        <span class="color-orange"> <?php echo trans('index.game'); ?> </span>
                        <span class="weight-normal">#</span>
                        <span id="roundId" class="color-white">{{ $game->id }}</span>
                    </div>
                </div>
                <span class="divider weight-normal"></span>
                <div class="right-block">
                    <div class="text-wrap">
                        <span class="color-orange"> <?php echo trans('index.bank'); ?> </span>
                        <span class="weight-normal">:</span>
                        <span id="roundBank" class="color-white">{{ round($game->price) }} <span class="money" style="color: #b3e5ff;"> <?php echo trans('index.rubcaps'); ?> </span></span>
                    </div>
                </div>
            </div>
 <?php $music = @$_SESSION['music']; ?>
<span class="text sound_on" style="<?=$music ? 'display: none;' : '';?>"> <img src="{{ asset('assets/img/sound-on.png') }}"> </span> 
<span class="text sound_off" style="<?=$music ? '' : 'display: none;';?>"> <img src="{{ asset('assets/img/sound-off.png') }}"> </span>

            <div id="barContainer" class="bar-container">
                <div class="item-bar-wrap">
                    <div class="item-bar-text"><span>{{ $game->items }}<span style="font-weight: 100;"> / </span>100</span> {{ trans_choice('lang.items', $game->items) }}</div>
                    <div class="item-bar" style="width: {{ $game->items }}%;"></div>
                </div>
                <div class="bar-text"> <?php echo trans('index.ilicherez'); ?> </div>
                <div class="timer-new" id="gameTimer">
                    <span class="countMinutes">02</span>
                    <span class="countDiv">:</span>
                    <span class="countSeconds">00</span>
                </div>
            </div>

            <div id="usersCarouselConatiner" class="player-list" style="width: 20000px; display: none;">
                <ul id="usersCarousel" class="list-reset">
                </ul>
            </div>
        </div>
    </div>

    <div id="winnerInfo" class="game-info-additional" style="padding: 20px 0px 0px; display: none;">
        <div class="winner-info-holder" style="padding: 0px 5px 18px; display: none;">
            <div class="left-block">
                <div class="additional-text">
                    <?php echo trans('index.winerbilet'); ?> <span class="color-green" id="winTicket">#0</span> <span class="text-small">( <?php echo trans('index.vsegocaps'); ?> <span id="totalTickets">0</span>)</span> <a href="#" onclick="document.forms[0].submit(); return false;" class="check-btn-empty"> <?php echo trans('index.proverit'); ?> </a><br/>
                    <?php echo trans('index.pobediligrok'); ?> <div class="img-wrap"><img src=""></div> <a href="#" target="_blank" class="link-user color-yellow" id="winnerLink">login</a> <span class="text-small" id="winnerChance">(0)</span><br/>
                    <?php echo trans('index.prize'); ?> <span class="winning-sum" id="winnerSum">0</span> <span class="text-small"> <?php echo trans('index.rub'); ?> </span>
                </div>
            </div>
            <div class="right-block">
                <div class="newGemaText"> <?php echo trans('index.newgamecherez'); ?> </div>
                <div class="timer-new" id="newGameTimer">
                    <span class="countMinutes">00</span>
                    <span class="countDiv">:</span>
                    <span class="countSeconds">00</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Chat -->

    <div id="chatHeader" style="display: none;"> <?php echo trans('index.chat'); ?> </div>

    <div id="chatContainer" class="chat-with-prompt" style="display: none;">
        <span id="chatClose" class="chat-close"></span>
        <div id="chatHeader"> <?php echo trans('index.chat'); ?> </div>

            <div class="chat-prompt"> <?php echo trans('index.chat'); ?> </div>

        <div id="chatScroll">
            <div id="messages">
            </div>
        </div>

        @if(!Auth::guest())
        <form action="#" class="chat-form">
                <textarea id="chatInput" placeholder=" <?php echo trans('index.setmessage'); ?> "></textarea>
                <div class="chat-actions"><a id="chatRules" class="chat-rules"> <?php echo trans('index.rulescht'); ?> </a>
                    <button class="chat-submit-btn"> <?php echo trans('index.send'); ?> </button>
                </div>
        </form>
        @else
            <a id="notLoggedIn" href="{{ route('login') }}"> <?php echo trans('index.loginsteam'); ?> </a>
        @endif

    </div>

    <!-- Chat END -->

  <div id="depositButtonsBlock" class="additional-block-wrap" style="">

        <div id="depositButtons" class="additional-container">
            @if(Auth::guest())
            <div class="participate-block">
                <span class="icon-arrow-right"></span>
                <p>
                    <?php echo trans('index.chem'); ?> <span class="color-lightblue"> <?php echo trans('index.doroge'); ?> </span> <?php echo trans('index.predmetivistavite'); ?>,<br>
                    <?php echo trans('index.tem'); ?> <span class="color-lightblue"> <?php echo trans('index.vishe'); ?> </span> <?php echo trans('index.chansenawin'); ?> 
                </p>
                <span class="icon-arrow-right"></span>
                <p>
                    <?php echo trans('index.pobeditelvibietsya'); ?> <br>
                    <span class="color-lightblue"> <?php echo trans('index.100items'); ?> </span> <?php echo trans('index.iliproidet'); ?> <span class="color-lightblue"> <?php echo trans('index.120sec'); ?> </span>
                </p>
                <span class="icon-arrow-right" style="margin: 0 20px;"></span>
                <a href="/login" class="add-deposit" style="float: right;margin: 10px 4px 0px 0px;padding: 10px 40px;"> <?php echo trans('index.prinatuchastie'); ?> </a>
                @else
                    <div class="participate-block participate-logged">
                        <div style="float: left">
                            <span class="icon-arrow-right" style="margin: 0px 15px 0px -15px;"></span>
                            <div class="participate-info"> <?php echo trans('index.vivnesli'); ?> <span id="myItemsCount">{{ $user_items }}<span style="font-size: 12px;"> {{ trans_choice('lang.items', $user_items) }}</span></span><br> <?php echo trans('index.vashchansenapobedu'); ?> <span id="myChance">{{ $user_chance }}%</span></div>
                        </div>

                        <div style="float: right">
                            <span class="icon-arrow-right" style="margin: 0px 20px 0px 0px;"></span>

                            <div id="cardDepModal" class="makeCardDeposit"> <?php echo trans('index.vnesticartochki'); ?> </div>
                            <div class="card-or-item"> <?php echo trans('index.ili'); ?> </div>
                            <a id="depositButton" href="{{ route('deposit') }}" target="_blank" class="add-deposit @if(empty($u->accessToken)) no-link @endif"> <?php echo trans('index.vnestipredmeti'); ?> </a>

                            <span class="icon-arrow-left" style="margin: 0px 0px 0px 25px;"></span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="deposit-confirm-head wait-msg" style="display: none;">
                <div class="left-block trade-text">
                </div>
                <div class="right-block">
                    <div class="hourglass"> <?php echo trans('index.waitdeposit'); ?> </div>
                </div>
            </div>

            <div class="deposit-confirm-head error-msg" style="display: none;">
                <div class="left-block trade-text">
                    <span style="color: #F9C2C2;"> <?php echo trans('index.depositerror'); ?> ,</span> <?php echo trans('index.depositerror1'); ?> 
                </div>
                <div class="right-block">
                    <div id="chooseGameTradeBtn" class="adBtn greenBtn" data-id=""> <?php echo trans('index.vnestivigru'); ?> </div>
                </div>
            </div>


        <div id="minDepositMessage" class="msg-wrap">
            <div class="deposit-txt-info">
                <?php echo trans('index.minimaldeposit'); ?> {{ $min_price = \App\Http\Controllers\GameController::MIN_PRICE }} <?php echo trans('index.rublei'); ?> <?php echo trans('index.maxdeposit'); ?> - {{ $max_items = \App\Http\Controllers\GameController::MAX_ITEMS }} <?php echo trans('index.predmetov'); ?> 
            </div>
        </div>
       </div>


        <div id="usersChances" class="coursk" @if($game->items == 0) style="display: none; @endif">
            <div id="showUsers" class="iusers active" title=" <?php echo trans('index.showplayer'); ?> "></div>
            <div class="arrowscroll left"></div>
            <div class="current-chance-block users">
                <div class="current-chance-wrap">
                    @foreach($chances as $info)
                        <div class="current-user" title="" data-original-title="{{ $info->username }}"><a class="img-wrap" href="/user/{{ $info->steamid64 }}" target="_blank"><img src="{{ $info->avatar }}"></a><div class="chance">{{ $info->chance }}%</div></div>
                    @endforeach
                </div>
            </div>
            <div class="current-chance-block items" style="display: none;">
                <div class="current-chance-wrap">
                    @foreach($bets as $bet)
                        @foreach(json_decode($bet->items) as $i)
                            @if(!isset($i->img))
                            <div class="deposit-item {{ $i->rarity }}"
                                 market_hash_name="" title="{{ $i->name }}" data-toggle="tooltip">
                                <div class="deposit-item-wrap">
                                    @if(!isset($i->img))
                                        <div class="img-wrap"><img
                                                    src="https://steamcommunity-a.akamaihd.net/economy/image/class/{{ \App\Http\Controllers\GameController::APPID }}/{{ $i->classid }}/100fx100f">
                                        </div>
                                    @else
                                        <div class="img-wrap"><img src="{{ asset($i->img) }}"></div>
                                    @endif
                                </div>
                                <div class="deposit-price">{{ $i->price }} <span> <?php echo trans('index.rub'); ?> </span>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="arrowscroll right" style="display: none;"></div>
            <div id="showItems" class="iskins" title=" <?php echo trans('index.pokazatpredmeti'); ?> "></div>
        </div>

        <div id="errorBlock" class="msg-big msg-error" style="display: none;">
            <div class="msg-wrap">
                <h2> <?php echo trans('index.obmenotklonen'); ?> </h2>
                <p></p>
            </div>
        </div>


    <div id="linkBlock" class="msg-big msg-offerlink" style="display: none;">
        <div class="msg-wrap">
            <h2> <?php echo trans('index.addurlobmen'); ?> </h2>
            <div class="input-group">
                <input class="save-trade-link-input" style="margin-left: 115px;" type="text" placeholder=" <?php echo trans('index.vveditetuturlobmen'); ?> " />
                <span class="save-trade-link-input-btn"></span>
                <a class="getLink-index" href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank"> <?php echo trans('index.uznatmyurlnaobmen'); ?> </a>
            </div>
        </div>
    </div>

    <div id="roundFinishBlock" class="msg-big msg-finish" style="display: none;">
        <div class="msg-wrap">
            <h2> <?php echo trans('index.gameover'); ?> </h2>
            <a href="/fairplay" class="btn-fairplay"> <?php echo trans('index.fairplay'); ?> </a>
            <p> <?php echo trans('index.roundnumber'); ?> <span class="underline number">0</span></p>
            <a href="#" onclick="document.forms[0].submit(); return false;" class="check-btn-green"> <?php echo trans('index.check'); ?> </a>
            <div class="date"></div>
        </div>
    </div>

        <div style="display: none;">
            <div class="box-modal affiliate-program" id="chatRulesModal">
                <div class="box-modal-head">
                    <div class="box-modal_close arcticmodal-close"></div>
                </div>
                <div class="box-modal-content">
                    <div class="content-block">
                        <div class="title-block">
                            <h2> <?php echo trans('index.ruleschat'); ?> </h2>
                        </div>
                    </div>
                    <div class="text-block-wrap">
                        <div class="text-block">
                            <div class="page-main-block" style="text-align: left !important;">
                                <div class="page-block"> <?php echo trans('index.24chasa'); ?> </div>

                                <div class="page-mini-title"> <?php echo trans('index.chatstop'); ?> </div>
                                <div class="page-block">
                                    <ul>
                                        <li style="margin-bottom: 5px;"> <?php echo trans('index.spam'); ?> ;</li>
                                        <li style="margin-bottom: 5px;"> <?php echo trans('index.oskorblat'); ?> ;</li>
                                        <li style="margin-bottom: 5px;"> <?php echo trans('index.chaturlstop'); ?> ;</li>
                                        <li style="margin-bottom: 5px;"> <?php echo trans('index.prositskini'); ?> ;</li>
                                        <li style="margin-bottom: 0px;"> <?php echo trans('index.chatstopprodaga'); ?> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deposits">
        @foreach($bets as $bet)
            @include('includes.bet')
        @endforeach
    </div>

    <div id="roundStartBlock" class="msg-big msg-start">
        <div class="msg-wrap">
            <h2> <?php echo trans('index.gamestartgodeposit'); ?> </h2>
            <a href="/fairplay" class="btn-fairplay"> <?php echo trans('index.fairplay'); ?> </a>
            <p> <?php echo trans('index.hash'); ?> <span id="hash" class="underline">{{ md5($game->rand_number) }}</span></p>
            <div class="date">{{ $game->updated_at->format('d.m.Y') }}<span>{{ $game->updated_at->format(' - H:i') }}</span></div>
        </div>
    </div>

        @if(!Auth::guest())
            <div style="display: none;">
                <div class="box-modal b-modal-cards" id="cardDepositModal">
                    <div class="box-modal-container">
                        <div class="box-modal_close arcticmodal-close"></div>


                        <div class="box-modal-content">

                            <div class="box-modal-head">
                                <div class="modal-head-info">
                                    <div class="modal-info-item">
                                        <?php echo trans('index.uvas'); ?> <span id="my-cards-count">0 <span class="cards-price-currency"> <?php echo trans('index.cartochek'); ?> </span></span>
                                    </div>
                                    <span class="icon-arrow-right"></span>
                                    <div class="modal-info-item">
                                        <?php echo trans('index.stoimostyou'); ?> <span id="my-cards-price">0 <span class="cards-price-currency"> <?php echo trans('index.rub'); ?> </span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="cards-cont">
                                <div class="msg-wrap" style="margin-bottom: -17px;">
                                    <div class="icon-warning"></div>
                                    <div class="msg-green msg-mini" id="whenLoadingOrNoCardsOrTitle"> <?php echo trans('index.netcart'); ?> </div>
                                </div>
                                <div class="cards-block-up" style="display: none;">
                                    <ul class="list-reset" id="cardsList" style="display: none;"></ul>
                                </div>

                                <div class="cards-choice-text" style="display: none" id="choiceCardsPriceInfo">
                                    <div class="modal-info-item"> <?php echo trans('index.vivibrali'); ?> <span id="cards-choice-count">0<?php echo trans('index.kartochek'); ?> </span>,</div>
                                    <div class="modal-info-item"> <?php echo trans('index.stoimostyou'); ?> <span id="cards-choice-price">0</span> <div class="price-currency"> <?php echo trans('index.rub'); ?> </div></div>
                                    <div class="makeCardDeposit" id="depositCards" style="float: right; padding: 8px 25px; width: auto; margin-top: 5px;"> <?php echo trans('index.vnestivraund'); ?> </div>
                                </div>
                            </div>

                            <div class="add-balance-block">
                                <div class="balance-item">
                                    <?php echo trans('index.vashbalans'); ?> 
                                    <span class="userBalance">{{ $u->money }} </span> <div class="price-currency">{{ trans_choice('lang.rubles', $u->money) }}</div>
                                </div>

                                <span class="icon-arrow-right"></span>
								<div id="GDonate" class="input-group">
                                    <form method="GET" action="/pay">
                                        <input type="hidden" name="user_id" value="{{ $u->id }}">
                                        <input type="text" name="sum" placeholder="<?php echo trans('index.vvedytesummu'); ?>">
                                        <button type="submit" class="btn-add-balance" name=""><?php echo trans('index.popolnit'); ?></button>
                                    </form>
                                </div>

                                <div class="payment-methods" style="display:none;" id="moneySystems">
                                    <div class="payment-title"> <?php echo trans('index.selectpaymetod'); ?> </div>
                                    <ul class="list-reset">
                                        <li><div data-money="qiwi" class="payment-qiwi" title="С помощью Qiwi"><span>Qiwi</span></div></li>
                                        <li><div data-money="wm" class="payment-webmoney" title="С помощью Webmoney"><span>Webmoney</span></div></li>
                                        <li><div data-money="yd" class="payment-yandex" title="С помощью Yandex Money"><span>Яндекс</span></div></li>
                                        <li><div data-money="mob" class="payment-phone" title="С помощью телефона"><span>Телефон</span></div></li>
                                        <li><div data-money="card" class="payment-credit-card" title="С помощью кредитной карты"><span>Карточки</span></div></li>
                                        <li><div data-money="oth" class="payment-another" title="С помощью других способов"><span>Другие способы</span></div></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="cards-block-up-btn">
                                <ul class="list-reset">
                                    @foreach(\App\Ticket::all() as $ticket)
                                        <li class="up-card-{{ $ticket->id }}">
                                            <div class="up-price">
                                                {{ $ticket->price }} <small> <?php echo trans('index.rub'); ?> </small>
                                            </div>
                                            <span class="icon-up-card-{{ $ticket->id }}"></span>
                                            <div onclick="addTicket({{ $ticket->id }}, this)" class="buy-btn-sm"> <?php echo trans('index.kupit'); ?> </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="box-modal-footer">
                                <div class="msg-wrap" style="position: relative;">
                                    <div class="close-eto-delo box-modal_close" style="top: 6px; right: 6px; opacity: 0.8;"></div>
                                    <div class="msg-green" style="margin-left: 12px;margin-top: 20px;">
                                        <h2> <?php echo trans('index.zachemkarti'); ?> </h2>
                                        <p> <?php echo trans('index.depositcartaminichemne'); ?> </p>
                                        <p> <?php echo trans('index.depositskinami'); ?> </p>
                                        <p> <?php echo trans('index.kartochkineteryyout'); ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: none;">
                <div class="box-modal affiliate-program" id="card-popup">
                    <div class="box-modal-head">
                        <div class="box-modal_close arcticmodal-close"></div>
                    </div>
                    <div class="box-modal-content">
                        <div class="content-block">
                            <div class="title-block">
                                <h2> <?php echo trans('index.cartventurefast'); ?> </h2>
                            </div>
                        </div>
                        <div class="text-block-wrap">
                            <div class="text-block">
                                <p class="lead-big"> <?php echo trans('index.kartochkidepositom'); ?> 
                                    <br> <?php echo trans('index.cartochkivmestoskinovcsgo'); ?> </p>
                                <p class="lead-big" style="margin: 0px -20px 15px;background: rgba(20, 34, 41, 0.5);padding: 15px;-webkit-box-shadow: inset 0px 0px 10px -2px rgba(12, 19, 23, 0.5);box-shadow: inset 0px 0px 10px -2px rgba(12, 19, 23, 0.5);color: rgb(179, 218, 179);"> <?php echo trans('index.deposkartaminichemneotl'); ?> 
                                    <br> <?php echo trans('index.depositskinami1'); ?> 
                                    <br>
                                <p class="lead-normal" style="margin-bottom: 10px;">- <?php echo trans('index.cartmoment'); ?> ;</p>
                                <p class="lead-normal" style="margin-bottom: 10px;">- <?php echo trans('index.netskinov'); ?> ;</p>
                                <p class="lead-normal" style="margin-bottom: 10px;">- <?php echo trans('index.cartmoment1'); ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="{{ asset('assets/js/chat.js') }}" ></script>
        @endif

@endsection