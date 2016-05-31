@extends('layout')

@section('content')
    <div class="user-profile-container">

        <div class="user-profile-head">

            <div class="user-avatar">
                <img src="{{ $avatar }}">
            </div>

            <div class="left-block">

                <div class="user-info">
                    <div class="username">
                        {{ $username }}
                    </div>
                    <div class="reputation-container">
                        <?php echo trans('user.yourlevel'); ?> 
                        <div class="reputation-block">
                            {{ $votes }}
                            <a id="user-level-btn" class="popover-btn"></a>
                        </div>
                    </div>
                </div>

                <div class="right-block">
                    <ul class="list-reset">
                        <li> <?php echo trans('user.igri'); ?> <span>{{ $games }}</span></li>
                        <li> <?php echo trans('user.pobedi'); ?> <span class="lightgreen">{{ $wins }}</span></li>
                        <li>Win rate: <span class="lightgreen">{{ $winrate }}%</span></li>
                        <li> <?php echo trans('user.summaraundov'); ?><span class="currency-icon">{{ $totalBank }}</span></li>
                    </ul>
                </div>

                @if(!empty($u) && $u->steamid64 == $steamid)
                    <div class="input-group" style="width: 76.8%; position: relative;">
                        <input class="save-trade-link-input" type="text" placeholder="<?php echo trans('user.vveditevashussilku'); ?>" value="{{ $u->trade_link }}">
                   <span class="save-trade-link-input-btn"></span>
                    </div>
                    <a class="getLink" href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank"><?php echo trans('user.uznatssilku'); ?></a>
                @else
                    <div class="input-group">
                        <a class="userLink" href="{{ $url }}" target="_blank">{{ $url }}</a>
                    </div>
                @endif

            </div>

        </div>

        <div class="user-profile-content">
            <table>
                <tbody id="showMoreContainer">

                @foreach($list as $game)
                    <tr>
                        <td><a href="/game/{{ $game -> id }}" class="game-number"> <?php echo trans('user.igra'); ?> <span>{{ $game -> id }}</span></a></td>
                        <td class="round-money">{{ $game -> bank }}</td>
                        <td class="game-status">
                            @if($game->win == 1)
                                <span class="prize-status status-win"> <?php echo trans('user.pobeda'); ?> </span>
                            @elseif($game->win == -1)
                                <span class="prize-status status-wait"> <?php echo trans('user.noend'); ?> </span>
                            @else
                                <span class="prize-status status-err"> <?php echo trans('user.proigrish'); ?> </span>
                            @endif
                        </td>
                        <td class="chance-td">
                            <div class="chance"> <?php echo trans('user.schansom'); ?> <span>{{ $game -> chance }}%</span> </div>
                        </td>
                        <td><a href="/game/{{ $game -> id }}" class="round-history"> <?php echo trans('user.posmotrethistorygame'); ?> </a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection