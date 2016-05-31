@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}"/>
    <script src="{{ asset('assets/js/shop.js') }}"></script>

    @if(!Auth::guest())
	<div class="title-block">
		<h2>
			Магазин
		</h2>
	</div>

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
                        <span class="text">Предметы отправляются не более</span>

                        <div class="sum-block" id="my-cards-count">5 <span class="cards-price-currency">минут</span>
                        </div>
                    </div>
                    <span class="icon-arrow-right"></span>

                    <div class="buy-card-item">
                        <span class="text">Трейд отменяется через</span>

                        <div class="sum-block" id="my-cards-price">30 <span class="cards-price-currency">минут</span>
                        </div>
                    </div>
					
						<span class="icon-arrow-right" style="margin: 0px 20px 0px 0px;"></span>
						<a href="https://steamcommunity.com/profiles/76561198251499116/inventory/#730" target="_blank" style="float: initial;" class="btn-vk">Инвентарь бота</a>
						<span class="icon-arrow-left" style="margin: 0px 0px 0px 25px;"></span>
                </div>
            </div>

            <div class="buy-cards-block">
                <div class="msg-wrap">
                    <div class="icon-warning"></div>
                    <div class="msg-green msg-mini" id="whenLoadingOrNoCardsOrTitle">На вашем аккаунте есть средства за которые вы можете покупать предметы или карточки!</div>
                </div>
&nbsp
		<div id="minDepositMessage" class="msg-wrap">
            <div class="deposit-txt-info">
                <b>ВНИМАНИЕ!</b> <b><span style="color: #FFF700">НЕ</span></b> ПЫТАЙТЕСЬ ПОКУПАТЬ НЕСКОЛЬКО ВЕЩЕЙ ОДНОВРЕМЕННО. ЖДИТЕ, ПОКА ВАМ ПРИДЁТ ТРЕЙД С ОДНОЙ ВЕЩЬЮ, А ЗАТЕМ ПОКУПАЙТЕ СЛЕДУЮЩУЮ. ДЕНЬГИ, ПОТЕРЯННЫЕ ТАКИМ СПОСОБОМ МЫ НЕ МОЖЕМ ВОССТАНОВИТЬ!
            </div>
        </div>
                <div class="cards-block-up" style="padding: 10px 0px 0px; margin-left: -5px; display: none;">
                    <ul class="list-reset" id="cardsList">
                    </ul>
                </div>
            </div>


            <div class="green-txt-info">
				@if($u->trade_link)
					Проверьте вашу ссыку на обмен: {{$u->trade_link}}
				@endif 
				@if(!$u->trade_link)
					Нет ссылки для обмена!
				@endif

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

            <div id="items-list" class="items-list" style="display: block;">
			
                <script type="text/template" id="item-template">
                    <div class="deposit-item <%= className %> up-<%= className %>" onclick="buy( <%= id %> )">
					<div class="deposit-item-wrap">
                        <div class="img-wrap"><img src="<%= image %>" alt="" title=""/></div>
                            <div class="name"><%= name %></div>
							<div class="deposit-price"><%= priceText %> <span>руб</span></div>
							<div class="deposit-exterior"><%= shortexterior %></div>
                            <div class="deposit-count">x<%= count %></div>
							
						</div>
                    </div>
                </script>

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
