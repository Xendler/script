@extends('layout')

<div class="user-history-block">
@section('content')
       <div class="title-block">
         <h2><?php echo trans('history.title'); ?></h2>
           </div>
             <div class="user-history-content">
            @forelse($games as $game)
               <div class="prize-container">
                 <div class="prize-head">
                     <div class="left-block">
                          <div class="prize-number">
                          <a href="/game/{{ $game->id }}"> <?php echo trans('history.game'); ?> <span>#{{ $game->id }}</span></a>
                          <a href="/game/{{ $game->id }}" class="round-history"> <?php echo trans('history.gamehistory'); ?> </a>
                          </div>
                     <div class="prize-info">
                          <div class="winner-name">
                          <span class="chance chance-two"> <?php echo trans('history.chance'); ?> <span>{{ \App\Http\Controllers\GameController::_getUserChanceOfGame($game->winner, $game) }}%</span></span>
                          <?php echo trans('history.winne'); ?> 
                          <div class="img-wrap"><img src="{{ $game->winner->avatar }}" />
                          </div>
                          <a href="/user/{{ $game->winner->steamid64 }}" class="user-name">{{ $game->winner->username }}</a>
                          </div>
                    <div class="round-sum">
                        <?php echo trans('history.bank'); ?> 
                        <span>{{ $game->price }}</span> <?php echo trans('history.money'); ?> 
                    </div>
                </div>
            </div>

            <div class="right-block" style="background: none; width: 220px;">
                <div class="publ right-content">
                    @if($game->status_prize == \App\Game::STATUS_PRIZE_WAIT_TO_SENT)
                      <span class="prize-status status-waiting"> <?php echo trans('history.sendprize'); ?> </span>
                    @elseif($game->status_prize == \App\Game::STATUS_PRIZE_SEND)
                      <span class="prize-status status-success"> <?php echo trans('history.prizesend'); ?> </span>
                    @else
                      <div class="prize-status status-error"> <?php echo trans('history.senderror'); ?> </div>
                    @endif
                </div>
            </div>

             @if($game->status_prize == \App\Game::STATUS_PRIZE_WAIT_TO_SENT)
                <div class="date color-lightyellow">{{ $game->updated_at->format('d.m.Y')  }}<span>{{ $game->updated_at->format(' - H:i') }}</span></div>
             @elseif($game->status_prize == \App\Game::STATUS_PRIZE_SEND)
                <div class="date color-lightgreen">{{ $game->updated_at->format('d.m.Y') }}<span>{{ $game->updated_at->format(' - H:i') }}</span></div>
             @else
                <div class="date color-lightred">{{ $game->updated_at->format('d.m.Y') }}<span>{{ $game->updated_at->format(' - H:i') }}</span></div>
             @endif

        </div>
       </div>
            @empty
            <div class="deposit-txt-info">
                 <?php echo trans('history.nogame'); ?> 
            </div>
            @endforelse
       </div>

        <div class="msg-wrap">
            <div class="icon-inform-white"></div>
            <div class="msg-white msg-mini">
                <?php echo trans('history.endgamehistory'); ?> <span>20 <?php echo trans('history.20game'); ?> </span> <?php echo trans('history.viewallgame'); ?>
                <span class="color-lightblue-t"><span class="weight-normal">venturefast.ru/game/</span> <?php echo trans('history.numbergame'); ?> </span>
            </div>
        </div>
@endsection