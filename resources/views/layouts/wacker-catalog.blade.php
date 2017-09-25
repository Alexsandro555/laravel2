<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{asset('normalize.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/wacker/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wacker</title>
</head>
<body>
<div id="app">
    <header class="header-page">
        <div class="header-page__layout">
            <div class="header-page__main">
                <div class="logo">
                    <div class="logo__layer">
                        <img src="{{asset('css/wacker/img/logo.png')}}"/>
                    </div>
                </div>
                <div class="header-center">
                    <nav class="menu-nav">
                        <ul>
                            <li><span>О КОМПАНИИ</span></li>
                            <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>НОВОСТИ</span></li>
                            <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>ОБОРУДОВАНИЕ</span></li>
                            <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>ДОСТАВКА И ОПЛАТА</span></li>
                            <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>КОНТАКТЫ</span></li>
                        </ul>
                    </nav>
                    <div class="header-info">
                        <div class="header-info__search">
                            <input type="text" placeholder=" найти на сайте" />
                            <button class="search-button"><img src="{{asset('css/wacker/img/search-icon.png')}}"/></button>
                        </div>
                        <div class="header-info__address">
                            <span><img src="{{asset('css/wacker/img/address-email.png')}}"/>&nbsp;&nbsp;info@oooleader.ru</span><br>
                            <span><img src="{{asset('css/wacker/img/address-marker.png')}}"/>&nbsp;&nbsp; Г.Москва, Большая Семеновская д.15</span>
                        </div>
                    </div>
                </div>
                <div class="header-phone">
                    <div>Звоните! <br><span>+7 (495) <b>780 47 96</b></span></div>
                    <button class="back-call">ЗАКАЗАТЬ <img src="{{asset('css/wacker/img/phone-img.png')}}"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ЗВОНОК</button>
                </div>
            </div>
        </div>
    </header>
    <div class="content-wrapper">
        <div class="content">
            <div class="menu-slider" style="display: flex;">
                <carousel style="width: 1100px; height: 120px"  :pagination-enabled=false :navigation-enabled=true :per-page=8  :per-page-custom="[[480, 8], [768, 8]]">
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                    <slide>
                        <div class="content__slider">
                            <img src="{{asset('css/wacker/img/carouser-image-1.png')}}"/><br>
                            <span>Виброплиты</span>
                        </div>
                    </slide>
                </carousel>
            </div>
            <div class="menu-left-wrapper">
                <div class="menu-left">
                    <div class="menu-left__header">КАТАЛОГ ПРОДУКЦИИ</div>
                    <ul>
                        <li>глубинные вибраторы</li>
                        <li>преобразователи частоты</li>
                        <li>внешние вибраторы</li>
                        <li>затирочные швы</li>
                        <li>виброрейки</li>
                        <li>арматурный инструмент</li>
                        <li>виброплиты</li>
                        <li>вибротрамбовка</li>
                        <li>катки</li>
                        <li>осветительные мачты и вышки</li>
                        <li>тепловое оборудование</li>
                        <li>отбойные молотки</li>
                        <li>осушители воздуха</li>
                        <li>шоврезчики и бензорезы</li>
                        <li>мотопомпы</li>
                        <li>насосы</li>
                        <li>генераторы</li>
                        <li>экскаваторы</li>
                        <li>погрузчики</li>
                        <li>думперы</li>
                        <li>телескопические погрузчики</li>
                        <li>мини погрузчики</li>
                    </ul>
                    <div class="menu-left__toggle">РАЗВЕРНУТЬ</div>
                </div>
            </div>
            <div class="content__catalog">
                <p>
                    Главная <img src="{{asset('css/wacker/img/breadcrumbs.png')}}" class="breadrcumbs"> Внутреняя
                </p>
                <div class="content__header">
                    <h2>Глубинные вибраторы Wacker Neuson</h2>
                    <img src="{{asset('css/wacker/img/gears-dark.png')}}" />
                </div>
                <p>
                    Компания Wacker Neuson зарекомендовала себя как производитель <br>
                    высочайших по уровню качества и надежности вибраторов для бетона.<br>
                    ПРИМЕР расчета стоимости эксплуатации глубинных вибраторов HMS по <br>
                    ссылке.
                </p>
            </div>
            <div class="clear"></div>
            <div class="main_products">
                <div class="main_products__item">
                        <div class="main_products__image">
                            <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                        </div><br>
                        <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
                <div class="main_products__item">
                    <div class="main_products__image">
                        <img src="{{asset('css/wacker/img/main_product__image.png')}}"/>
                    </div><br>
                    <div class="main_products__line">Высокочастотные вибраторы (от сети 220 V~)</div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-catalog-wrapper">
        <div class="sub-catalog">
            <br>
            <div class="about__header-catalog">
                <h2>Модульные глубинные вибраторы</h2>
                <img src="{{asset('css/wacker/img/gears-dark.png')}}" />
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
            <div class="sub-catalog__content-slider">
                <div class="wrap">
                    <div class="sub-catalog__image">
                        <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                    </div><br><br>
                    <a href="#">Название товара может быть длинным</a><br><br>
                    <span>3 123 456 </span> р.<br><br>
                    <div class="sub-catalog__adv-info">
                        <span class="sub-catalog__IEC">IEC 38/230/5/15</span><br>
                        <span class="sub-catalog-desc">Описание товара будет располагаться тут</span><br>
                        <button class="sub-catalog__detail">ПОДРОБНЕЕ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wacker">
        <div class="wacker__wrapper">
            <div class="wacker__content">
                <div class="wacker-news">
                    <h2>НОВОСТИ КОМПАНИИ</h2>
                    <div class="wacker-news__item">
							<span>
								<div class="wacker-news__date">12.05.2017</div>
								<a href="#">Заголовок тестовой новости</a><br>
								Это пример текста новости, создан для примера. Краткий анонс...
								<br>
								<br>
							</span>
                    </div>
                    <div class="wacker-news__item">
							<span>
								<div class="wacker-news__date">12.05.2017</div>
								<a href="#">Заголовок тестовой новости</a><br>
								Это пример текста новости, создан для примера. Краткий анонс...
								<br>
								<br>
							</span>
                    </div>
                    <button class="wacker-news__button">ВСЕ НОВОСТИ</button>
                </div>
                <div class="wacker__carousel">
                    <div class="wacker__header">
                        <h2>Высокочастотные вибраторы со встроенным преобразователем</h2>
                        <img src="{{asset('css/wacker/img/gears-dark.png')}}" />
                    </div>
                <div class="service__menu-slider" style="display: flex;">
                    <carousel name="carousel2" style="width: 750px; height: 326px"  :pagination-enabled=false :navigation-enabled=true :per-page=3  :per-page-custom="[[480, 3], [768, 3]]">
                        <slide>
                            <div class="service__content-slider">
                                <div class="service__image">
                                    <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                                </div><br><br>
                                <a href="#">Название товара может быть длинным</a><br><br>
                                <span>3 123 456 </span> р.
                            </div>
                        </slide>
                        <slide>
                            <div class="service__content-slider">
                                <div class="service__image">
                                    <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                                </div><br><br>
                                <a href="#">Название товара может быть длинным</a><br><br>
                                <span>3 123 456 </span> р.
                            </div>
                        </slide>
                        <slide>
                            <div class="service__content-slider">
                                <div class="service__image">
                                    <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                                </div><br><br>
                                <a href="#">Название товара может быть длинным</a><br><br>
                                <span>3 123 456 </span> р.
                            </div>
                        </slide>
                        <slide>
                            <div class="service__content-slider">
                                <div class="service__image">
                                    <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                                </div><br><br>
                                <a href="#">Название товара может быть длинным</a><br><br>
                                <span>3 123 456 </span> р.
                            </div>
                        </slide>
                        <slide>
                            <div class="service__content-slider">
                                <div class="service__image">
                                    <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                                </div><br><br>
                                <a href="#">Название товара может быть длинным</a><br><br>
                                <span>3 123 456 </span> р.
                            </div>
                        </slide>
                        <slide>
                            <div class="service__content-slider">
                                <div class="service__image">
                                    <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                                </div><br><br>
                                <a href="#">Название товара может быть длинным</a><br><br>
                                <span>3 123 456 </span> р.
                            </div>
                        </slide>
                        <slide>
                            <div class="service__content-slider">
                                <div class="service__image">
                                    <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                                </div><br><br>
                                <a href="#">Название товара может быть длинным</a><br><br>
                                <span>3 123 456 </span> р.
                            </div>
                        </slide>
                    </carousel>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-line-1-wrapper">
        <div class="product-line-1">
            <div class="product-line-1__header-catalog">
                <h2>Высокочастотные глубинные вибраторы</h2>
                <img src="{{asset('css/wacker/img/gears-dark.png')}}" />
            </div>
            <div class="service__menu-slider" style="display: flex; padding-left:60px;">
                <carousel name="carousel2" style="width: 1150px; height: 326px"  :pagination-enabled=false :navigation-enabled=true :per-page=4  :per-page-custom="[[480, 4], [768, 4]]">
                    <slide>
                        <div class="product-line-1__content-slider">
                            <div class="product-line-1__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="product-line-1__content-slider">
                            <div class="product-line-1__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="product-line-1__content-slider">
                            <div class="product-line-1__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="product-line-1__content-slider">
                            <div class="product-line-1__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="product-line-1__content-slider">
                            <div class="product-line-1__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="product-line-1__content-slider">
                            <div class="product-line-1__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="product-line-1__content-slider">
                            <div class="product-line-1__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                </carousel>
            </div>
        </div>
    </div>
    <div class="sub-catalog-wrapper">
        <div class="sub-catalog">
            <div class="sub-catalog__header-catalog">
                <h2>Пневматические глубинные вибраторы</h2>
                <img src="{{asset('css/wacker/img/gears-dark.png')}}" />
            </div>
            <div class="sub-catalog__menu-slider" style="display: flex; padding-left:60px;">
                <carousel name="carousel2" style="width: 1150px; height: 326px"  :pagination-enabled=false :navigation-enabled=true :per-page=4 :per-page-custom="[[480, 4], [768, 4]]">
                    <slide>
                        <div class="sub-catalog__content-slider">
                            <div class="sub-catalog__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="sub-catalog__content-slider">
                            <div class="sub-catalog__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="sub-catalog__content-slider">
                            <div class="sub-catalog__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="sub-catalog__content-slider">
                            <div class="sub-catalog__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="sub-catalog__content-slider">
                            <div class="sub-catalog__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="sub-catalog__content-slider">
                            <div class="sub-catalog__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                    <slide>
                        <div class="sub-catalog__content-slider">
                            <div class="sub-catalog__image">
                                <img src="{{asset('css/wacker/img/service-slider1.png')}}"/>
                            </div><br><br>
                            <a href="#">Название товара может быть длинным</a><br><br>
                            <span>3 123 456 </span> р.
                        </div>
                    </slide>
                </carousel>
            </div>
        </div>
    </div>
    <div class="catalog-description-wrapper">
        <div class="catalog-description">
            <div class="catalog-text">
                <h2>На сегодняшний день данная группа оборудования делится на:</h2>
                <ul>
                    <li>
                        Глубинные вибраторы для бетона с электромеханическим приводом (серия HMS)
                    </li>
                    <li>
                        Погружные высокочастотные для уплотнения бетона (серия IREN, IRFU)
                    </li>
                    <li>
                        Внешние для опалубки (серия AR)
                    </li>
                </ul>

                <h2>Глубинные вибраторы для бетона с электромеханическим приводом (серия HMS)</h2>
                HMS - система из электромеханического привода, гибкого вала и вибробулавы. Это трехсоставной механизм, где каждый элемент имеет свой артикул
                и при необходимости вал или булава могут заменяться. Приводы выпускаются разной мощьности от 1 до 2.1 кВт, валы разных длин от 1 до 9 метров,
                и наконец булавы разного диаметра от 25 до 65 мм. Системы креплений на приводах M1500 и M2500 унифицированны с валами SM3, SM4, SM5, SM7. Привод M1000
                выпускается для особых валов и булав, меньшей длины и диаметра соответственно. Приводы M2500 считаются самыми надежными (в линейке бренда), так как
                имеют хороший запас мощности и обмотку высокого класса. Даже при длительной эксплуатации такой привод сохраняет оптимальные показатели и эффективно
                передает вращательное движение через гибкий вал в вибробулаву.

                <h2>Погружные высокочастотные вибраторы для уплотнения бетона (серия IREN, IRFU)</h2>
                LoremIpsumLoremIpsumLoremIpsumLoremIpsumLoremIpsum LoremIpsumLoremIpsum LoremIpsumLoremIpsum LoremIpsumLoremIpsum v
                LoremIpsumLoremIpsumLoremIpsum LoremIpsumvv LoremIpsumvv vLoremIpsum LoremIpsum LoremIpsumLoremIpsumLoremIpsum
                LoremIpsumLoremIpsumvvvLoremIpsumv LoremIpsumLoremIpsum LoremIpsum LoremIpsumLoremIpsumv
                LoremIpsumLoremIpsumLoremIpsumvvvvLoremIpsumvLoremIpsumLoremIpsumLoremIpsumLoremIpsum
                LoremIpsumLoremIpsumvLoremIpsumvLoremIpsum
                LoremIpsumLoremIpsumLoremIpsumvLoremIpsumvvLoremIpsumvLoremIpsum
            </div>
        </div>
    </div>
    <div class="bottom-menu-wrapper">
        <div class="buttom-menu-container">
            <nav class="bottom-menu">
                <ul>
                    <li><span>О КОМПАНИИ</span></li>
                    <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>НОВОСТИ</span></li>
                    <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>ОБОРУДОВАНИЕ</span></li>
                    <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>ДОСТАВКА И ОПЛАТА</span></li>
                    <li><img src="{{asset('css/wacker/img/header_menu_img.png')}}"/><span>КОНТАКТЫ</span></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="footer-wrapper">
        <div class="footer__container">
            <div class="footer__menu">
                <ul>
                    <li>ГЛУБИННЫЕ ВИБРАТОРЫ</li>
                    <li>ПРЕОБРАЗОВАТЕЛИ ЧАСТОТЫ</li>
                    <li>ВНЕШНИЕ ВИБРАТОРЫ</li>
                    <li>ЗАТИРОЧНЫЕ МАШИНЫ</li>
                    <li>ВИБРОРЕЙКИ</li>
                    <li>АРМАТУРНЫЙ ИНСТРУМЕНТ</li>
                    <li>ТЕЛЕСКОПИЧЕСКИЕ ПОРУЗЧИКИ</li>
                    <li>ДУМПЕРЫ</li>
                </ul>
            </div>
            <div class="footer__menu">
                <ul>
                    <li>ВИБРОПЛИТЫ</li>
                    <li>ВИБРОТРАМБОВКА</li>
                    <li>КАТКИ</li>
                    <li>ОСВЕТИТЕЛЬНЫЕ МАЧТЫ И ВЫШКИ</li>
                    <li>ТЕПЛОВОЕ ОБОРУДОВАНИЕ</li>
                    <li>ОТБОЙНЫЕ МОЛОТКИ</li>
                    <li>МИНИ ПОГРУЗЧИКИ</li>
                </ul>
            </div>
            <div class="footer__menu">
                <ul>
                    <li>ОСУШИТЕЛИ ВОЗДУХА</li>
                    <li>ШОВРЕЗЧИКИ И БЕНЗОРЕЗЫ</li>
                    <li>МОТОПОМПЫ</li>
                    <li>НАСОСЫ</li>
                    <li>ГЕНЕРАТОРЫ</li>
                    <li>ЭКСКАВАТОРЫ</li>
                    <li>ПОГРУЗЧИКИ</li>
                </ul>
            </div>
            <div class="footer__info">
                <div class="footer__tel">
                    Звоните!<br>
                    <span>+7(495)<b>780 47 96</b></span>
                    <button class="back-call">ЗАКАЗАТЬ <img src="{{asset('css/wacker/img/phone-img.png')}}"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ЗВОНОК</button>
                    <p>
                    <div><img src="{{asset('css/wacker/img/footer-mail-img.png')}}"/><span> &nbsp;&nbsp;&nbsp;&nbsp;info@oooleader.ru</span></div>
                    <div><img src="{{asset('css/wacker/img/footer-map-img.png')}}"/><span>  Г.Москва, Большая <br> Семеновская д.15</span></div>
                    </p>
                </div>
                <div class="footer__logo">
                    <img src="{{asset('css/wacker/img/logo.png')}}"/>
                    <p>
                        Copyright 2017<br>
                        Компания Лидер
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}" type="application/javascript"></script>
<script>
    $(document).ready(function()
    {
       $('.menu-left ul').toggle('normal');
       $('.menu-left__toggle').click(function () {
           $(this).parent().children('ul').toggle('normal');
           if(this.innerHTML == 'РАЗВЕРНУТЬ') {
               this.innerHTML = 'СВЕРНУТЬ';
               $(".menu-left__toggle").addClass('rollup');
           }
           else
           {
               this.innerHTML = 'РАЗВЕРНУТЬ';
               $(".menu-left__toggle").removeClass('rollup');
           }
           return false;
       });
    });
</script>
</body>
</html>