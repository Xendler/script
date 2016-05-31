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
                        Репутация:
                        <div class="reputation-block">
                            {{ $votes }}
                            <a id="user-level-btn" class="popover-btn"></a>
                        </div>
                    </div>
                </div>

                <div class="right-block">
                    <ul class="list-reset">
                        <li>Игры: <span>{{ $games }}</span></li>
                        <li>Победы: <span class="lightgreen">{{ $wins }}</span></li>
                        <li>Win rate: <span class="lightgreen">{{ $winrate }}%</span></li>
                        <li>Сумма раундов: <span class="currency-icon">{{ $totalBank }}</span></li>
                    </ul>
                </div>

                @if(!empty($u) && $u->steamid64 == $steamid)
                    <div class="input-group" style="width: 76.8%; position: relative;">
                        <input class="save-trade-link-input" type="text" placeholder="Введите вашу ссылку на обмен" value="{{ $u->trade_link }}">
                        <span class="save-trade-link-input-btn"></span>
                    </div>
                    <a class="getLink" href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank">Узнать мою ссылку на обмен</a>
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
                        <td><a href="/game/{{ $game -> id }}" class="game-number">Игра
                                <span>{{ $game -> id }}</span></a></td>
                        <td class="round-money">{{ $game -> bank }}</td>
                        <td class="game-status">
                            @if($game->win == 1)
                                <span class="prize-status status-win">Победа</span>
                            @elseif($game->win == -1)
                                <span class="prize-status status-wait">Не завершена</span>
                            @else
                                <span class="prize-status status-err">Проигрыш</span>
                            @endif
                        </td>
                        <td class="chance-td">
                            <div class="chance">с шансом <span>{{ $game -> chance }}%</span></div>
                        </td>
                        <td><a href="/game/{{ $game -> id }}" class="round-history">Посмотреть историю игры</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection