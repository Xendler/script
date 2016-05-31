@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}"/>
    <script src="{{ asset('assets/js/shop.js') }}"></script>

    @if(!Auth::guest())
        <div class="buy-cards-container" style="padding-top: 10px;">
            <div class="buy-cards-block" style="margin-top: 0px; text-align:center;">
                <div class="buy-card-item" style="float: right; margin-top: 8px; display: inline-block;">
                    <span class="text">Ваш баланс:</span><br>

                    <div class="sum-block-inline">
                        <span class="userBalance" style="color: #d1ff78;font-size: 20px;">{{ $u->money }}</span> <span>руб</span>
                    </div>
                </div>

                <div style="float: left; display: inline-block">
                    <div class="buy-card-item">
                        <span class="text">У вас</span>

                        <div class="sum-block" id="my-cards-count">0 <span class="cards-price-currency"> карточек</span>
                        </div>
                    </div>
                    <span class="icon-arrow-right"></span>

                    <div class="buy-card-item">
                        <span class="text">Стоимостью</span>

                        <div class="sum-block" id="my-cards-price">0 <span class="cards-price-currency">руб.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="buy-cards-block">
                <div class="msg-wrap">
                    <div class="icon-warning"></div>
                    <div class="msg-green msg-mini" id="whenLoadingOrNoCardsOrTitle">У вас нет карточек</div>
                </div>

                <div class="cards-block-up" style="padding: 10px 0px 0px; margin-left: -5px; display: none;">
                    <ul class="list-reset" id="cardsList">
                    </ul>
                </div>
            </div>

            <div class="buy-cards-block" style="display: none" id="choiceCardsPriceInfo">
                <div class="buy-cards-change">
                    <div class="left-block">
                        Вы выбрали <span class="color-yellow-t" id="cards-choice-count">0 карточек</span>,
                        стоимостью <span class="color-yellow-t" id="cards-choice-price">0</span>
                        <span class="currency">руб. </span>
                    </div>
                    <div class="right-block">
                        <div class="right-content">
                            <div class="exchangeCards" style="width: auto;">Обменять на баланс</div>
                        </div>
                    </div>
                </div>
            </div>

            <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

            <div class="green-txt-info" style="margin-top: 21px;">
                На деньги, полученные от продажи карточек, вы можете купить предметы, которые представлены ниже
            </div>

            <div class="buy-cards-block" style="margin-top: 0px;">
                <div class="shop-item-filters">
                    <div class="left-totalitems">
                        Найдено предметов: <span id="filter-total">0</span> / <span
                                id="items-total">{{ \App\Shop::countItems() }}</span>
                    </div>
                    <a href="{{ route('cards-history') }}" class="myhistorylink">История моих покупок</a>

                    <div class="search-form">
                        <span class="search-btn"></span>
                        <input id="searchInput" type="text" placeholder="Поиск по названию">
                    </div>
                    <div class="price-form">
                        Цена:
                        от <input id="priceFrom" type="text" placeholder="0">
                        до <input id="priceTo" type="text" placeholder="0">
                    </div>
                </div>
            </div>

            <div id="items-list" style="display: block;">
                @forelse($items as $item)
                    <div class="deposit-item {{ \App\Shop::getClassRarity($item->rarity) }} up-{{ \App\Shop::getClassRarity($item->rarity) }}"
                         onclick="buy({{ $item->id }})">
                        <div class="deposit-item-wrap">
                            <div class="img-wrap">
                                <img src="https://steamcommunity-a.akamaihd.net/economy/image/class/{{ \App\Http\Controllers\GameController::APPID }}/{{ $item->classid }}/200fx200f">
                            </div>
                            <div class="name">{{ $item->name }} @if(!empty($item->quality))({{ $item->quality }}) @endif</div>
                            <div class="deposit-price">{{ floor($item->price) }} <span>руб</span></div>
                            <div class="deposit-count">x{{  \App\Shop::countItem($item->classid) }}</div>
                        </div>
                    </div>
                @empty
                    <center>Подождите немного. В данный момент идет обновления вещей.</center>
                @endforelse
            </div>

        </div>

        <script>
            function buy(id) {
                $.ajax({
                    url: '/shop/buy',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: id},
                    success: function (data) {
                        if (data.success) {

                            $.notify(data.msg, {className: "success"});
                            setTimeout(function () {
                                that.parent().parent().parent().hide()

                            }, 5500);
                        }
                        else {
                            if (data.msg) $.notify(data.msg, {className: "error"});
                        }
                    },
                    error: function () {
                        that.notify("Произошла ошибка. Попробуйте еще раз", {
                            className: "error"
                        });
                    }
                });
                return false;
            }


            function updateBalance() {
                $.post('/getBalance', function (data) {
                    $('.userBalance').text(data);
                });
            }
        </script>
    @else
        <div class="buy-cards-container">
            <div class="buy-cards-block">
                <div class="deposit-txt-info">Вам нужно авторизоваться</div>
            </div>
        </div>
    @endif
@endsection
