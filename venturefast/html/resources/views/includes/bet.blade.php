<div class="deposits-container">
    <div class="deposit-head">
        <div class="left-block">
            <div class="profile-img"><img src="{{ $bet->user->avatar }}">
            </div>
            <ul class="list-reset">
                <li class="profile-block"><span class="profile-name"><a href="/user/{{ $bet->user->steamid64 }}" style="color: #b4fca6;">{{ $bet->user->username }} </a></span> <span class="profile-level" data-original-title="" title=""></span> <span class="deposit-count"><?php echo trans('bet.get'); ?> {{ $bet->itemsCount }} {{ trans_choice('lang.items', $bet->itemsCount) }}</span>
                </li>
                <li class="deposit-sum">{{ $bet->price }} <span>руб</span>
                </li>
                <li class="deposit-chance">(<?php echo trans('bet.chance'); ?> <span class="id-{{ $bet->user->steamid64 }}">{{ \App\Http\Controllers\GameController::_getUserChanceOfGame($bet->user, $bet->game) }}%</span>)</li>
            </ul>
        </div>
        <div class="right-block">
            <div class="ticket-number" data-original-title="" title=""> <?php echo trans('bet.tickets'); ?> <span class="color-orange">#{{ round($bet->from) }}</span> <?php echo trans('bet.ticketsdo'); ?> <span class="color-orange">#{{ round($bet->to) }}</span> <span class="help"></span>
            </div>
        </div>
    </div>
    <div class="deposit-content">
        @foreach(json_decode($bet->items) as $i)
        <div class="deposit-item @if(!isset($i->img)){{ $i->rarity }} @else card up-card @endif" market_hash_name="" title="{{ $i->name }}" data-toggle="tooltip">
            <div class="deposit-item-wrap">
                @if(!isset($i->img))
                    <div class="img-wrap"><img src="https://steamcommunity-a.akamaihd.net/economy/image/class/{{ \App\Http\Controllers\GameController::APPID }}/{{ $i->classid }}/100fx100f"></div>
                @else
                    <div class="img-wrap"><img src="{{ asset($i->img) }}"></div>
                @endif
                </div>
                <div class="deposit-price">{{ $i->price }} <span>руб</span>
                </div>
            </div>
        @endforeach
        </div>
</div>
