@extends('layout')

@section('content')
    <div class="content-block">
        <div class="msg-wrap" style="display: none;">
            <div class="icon-shield-red"></div>
            <div class="msg-red msg-mini">
                У нас все по-честному. Победитель на нашем сайте определяется в прямом эфире через сервис Random.org
                <a href="/fairplay" class="btn-more arrow-sm">узнать подробнее</a>
            </div>
        </div>

        <div class="game-info-wrap" style="margin-bottom: 20px;">
            <div class="game-info" style="height: 186px;">
                <div class="game-info-title">
                    <div class="left-block">
                        <div class="text-wrap">
                            <span class="color-orange"> <?php echo trans('game.game'); ?> </span>
                            <span class="weight-normal">#</span>
                            <span class="color-white">{{ $game->id }}</span>
                        </div>
                    </div>
                    <span class="divider weight-normal"></span>
                    <div class="right-block">
                        <div class="text-wrap">
                            <span class="color-orange"> <?php echo trans('game.bank'); ?> </span>
                            <span class="weight-normal">:</span>
                    <span class="color-white">
                                                    {{ round($game->price) }}
                            <span class="money" style="color: #b3e5ff;"> <?php echo trans('game.rub'); ?> </span>
                                            </span>
                        </div>
                    </div>
                </div>

                <div class="game-round-finish">
                    <div class="game-info-additional">
                        <div class="left-block">
                            <div class="additional-text">
                                <?php echo trans('game.winerticket'); ?> <span class="winning-sum">#{{ floor($game->rand_number * $bankTotal = $game->price * 10) }}</span>
                                <span class="text-small">( <?php echo trans('game.vsego'); ?> {{ $bankTotal = $game->price * 10 }})</span>
                                <a href="/fairplay/{{ $game->id }}" class="check-btn-blue"> <?php echo trans('game.proverit'); ?> </a> <br>

                                <?php echo trans('game.winplayer'); ?> <div class="img-wrap"><img src="{{ $game->winner->avatar }}"></div> <a href="/user/{{ $game->winner->steamid64 }}" class="link-user color-yellow">{{ $game->winner->username }}</a>
                                <span class="text-small">( <?php echo trans('game.shanscaps'); ?> {{ \App\Http\Controllers\GameController::_getUserChanceOfGame($game->winner, $game) }}%)</span> <br>

                                <?php echo trans('game.winprize'); ?> 
                                <span class="winning-sum">{{ $game->price }}</span>
                                <span class="text-small"> <?php echo trans('game.rubcaps'); ?> </span>
                            </div>
                        </div>

                        <!--<div class="round-finish-title"> <?php echo trans('game.gameover'); ?> </div>!-->

                        <div class="right-block">
                            <a href="/game/{{ $game->id - 1 }}" class="btn-back-home"> <?php echo trans('game.viewgamepred'); ?> </a>
                            <a href="/" class="btn-back-home"> <?php echo trans('game.backhome'); ?> </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="usersChances" class="coursk">
            <div id="showUsers" class="iusers active" title=" <?php echo trans('game.vievplayer'); ?> "></div>
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
                                    <div class="deposit-price">{{ $i->price }} <span> <?php echo trans('game.rub'); ?> </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="arrowscroll right"></div>
            <div id="showItems" class="iskins" title=" <?php echo trans('game.viewitems'); ?> "></div>
        </div>

        <div id="errorBlock" class="msg-big msg-error" style="display: none;">
            <div class="msg-wrap">
                <h2> <?php echo trans('game.treidotklonen'); ?> </h2>
                <p></p>
            </div>
        </div>

        <div class="msg-big msg-finish">
            <div class="msg-wrap">
                <h2> <?php echo trans('game.igrazavershilas'); ?> </h2>
                <a href="/fairplay" class="btn-fairplay"> <?php echo trans('game.fairgame'); ?> </a>
                <p> <?php echo trans('game.roundsnumber'); ?> <span class="underline">{{ $game->rand_number }}</p>
                <div class="date">{{ $game->updated_at->format('d.m.Y') }}<span>{{ $game->updated_at->format(' - H:i') }}</span></div>
            </div>
        </div>

        <div id="deposits">
            @foreach($bets as $bet)
                @include('includes.bet')
            @endforeach
        </div>

        <div class="msg-big msg-start">
            <div class="msg-wrap">
                <h2> <?php echo trans('game.gamestart'); ?> </h2>
                <a href="/fairplay" class="btn-fairplay"> <?php echo trans('game.fairplay'); ?> </a>
                <p> <?php echo trans('game.hash'); ?> <span class="underline">{{ md5($game->rand_number) }}</span></p>
                <div class="date">{{ $game->created_at->format('d.m.Y') }}<span>{{ $game->created_at->format(' - H:i') }}</span></div>
            </div>
        </div>
    </div>
@endsection