<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{asset('storage/favicon_wam.ico')}}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{asset('normalize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('view.style')
    <title>Wam</title>
</head>
<body>
<div id="app">
    <header class="header-page">
        <div class="header-page__layout">
            <div class="header-page__main">
                <div class="header-center">
                    <nav class="menu-nav">
                        <ul>
                            <li><a href="#">О МАГАЗИНЕ</a></li>
                            <li><a href="#">ОПЛАТА</a></li>
                            <li><a href="#">ДОСТАВКА</a></li>
                            <li><a href="#">ОТДЕЛ ККТ</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="header-right">
                    <nav class="login">
                        <ul>
                            <li><a href="/login">Войти</a></li>
                            <li><a href="/register">Регистрация</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <nav class="menu-nav">
                        <ul>
                            <li><a href="#">ОСТАВИТЬ ОТЗЫВ</a></li>
                            <li><a href="#">ОПТОВИКАМ</a></li>
                            <li><a href="#">АКЦИИ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="logo-layer"><a href="/"><img src="{{asset('storage/logo-layer.png')}}"/></a></div>
                <div class="clear"></div>
                <span class="main-slogan">Технологическое оборудование <br> <span class="sub-slogan">для производств</span></span>
            </div>
        </div>
        <div class="header-page__contact-wrapper">
            <div class="header-page__contact">
                c 8 до 22 <span class="header__blue-mark">без выходных</span><br>
                <span class="header__tel">8 (495) 989 67 89</span><br>
                <a class="header__back-call" href="#">Заказать звонок</a>&nbsp;&nbsp;
                <a class="header-page__email" href="#">INFO@WAM.RU</a>
            </div>
        </div>
    </header>
    <div class="finder-wrapper">
        <div class="finder">
            <leader-cart-widget :cart-item="cart"></leader-cart-widget>
            <div class="finder__search">
                <input type="text" class="finder__input" placeholder=" Поиск по сайту" />
                <button class="search-button">
                    НАЙТИ
                </button>
            </div>
            <div class="menu-left-wrapper">
                <div class="menu-left">
                    <img class="menu-ugl" src="{{asset('storage/menu-left-ugl.png')}}"/>
                    <div class="menu-left__header">КАТАЛОГ ПРОДУКЦИИ</div>
                    <ul>
                        @foreach(App\MenuLeft::getMenu() as $menu)
                            <li><a href="{{route('wacker-catalog',['id'=>$menu->id])}}">{{$menu->title}}</a></li>
                        @endforeach
                    </ul>
                    <div class="menu-left__toggle">РАЗВЕРНУТЬ</div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="content">
            @yield('content-item')

            <!--<div class="content__item">
                    <div class="content__header">
                        <h2>НАШИ АКЦИИ И СПЕЦПРЕДЛОЖЕНИЯ</h2>
                    </div>
                    <button class="content-button">СМОТРЕТЬ ВСЕ</button>
                    <div class="main__content">
                        <div class="content__text">
                           <h2>ЗАГОЛОВОК СПЕЦПРЕДЛОЖЕНИЯ</h2>
                           <p>Краткое описание акции или предложения, <br>создан для примера</p>
                        </div>
                    </div>
            </div>-->
        </div>
    </div>
    @yield('content')
    <div class="footer">
        <div class="footer-wrapper">
            <div class="footer__content">
                <div class="footer__menu">
                    <div class="footer__menu-left">
                        <nav class="footer-menu">
                            <ul>
                                <li>
                                    <a href="#">О магазине</a>
                                </li>
                                <li>
                                    <a href="#">Оплата</a>
                                </li>
                                <li>
                                    <a href="#">Доставка</a>
                                </li>
                                <li>
                                    <a href="#">Отдел ККТ</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="footer__menu-right">
                        <nav class="footer-menu bottom-menu">
                            <ul>
                                <li>
                                    <a href="#">Оставить отзыв</a>
                                </li>
                                <li>
                                    <a href="#">Оптовикам</a>
                                </li>
                                <li>
                                    <a href="#">Акции</a>
                                </li>
                                <li>
                                    <a href="#">Контакты</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div>
                <div class="footer__catalog-prod">
                    <h3><img src="{{asset('storage/number8.png')}}"/>Каталог продукции</h3>
                    <nav class="footer__catalog-prod__menu">
                        <ul>
                            <?php $counterMenu = 1; ?>
                            @foreach(App\MenuLeft::getMenu() as $menu)
                                <li><a href="{{route('wacker-catalog',['id'=>$menu->id])}}">{{$menu->title}}</a></li>
                                <?php
                                $counterMenu++;
                                if($counterMenu>7)
                                {
                                    echo "</ul></nav><nav class='footer__catalog-prod__menu'><ul>";
                                    $counterMenu=1;
                                }
                                ?>
                            @endforeach
                            <!--<li>
                                <a href="#">Винтовые транспортеры</a>
                            </li>
                            <li>
                                <a href="#">Поворотные клапаны - роторные питатели</a>
                            </li>
                            <li>
                                <a href="#">Клапаны</a>
                            </li>
                            <li>
                                <a href="#">Разрядники сыпучих веществ</a>
                            </li>
                            <li>
                                <a href="#">Воздушные фильтры</a>
                            </li>
                            <li>
                                <a href="#">Горизонтальные сместители</a>
                            </li>
                        </ul>
                    </nav>
                    <nav class="footer__catalog-prod__menu">
                        <ul>
                            <li>
                                <a href="#">Патрубки</a>
                            </li>
                            <li>
                                <a href="#">Уровень контроля давления</a>
                            </li>
                            <li>
                                <a href="#">Загрузка BELLOWS</a>
                            </li>
                            <li>
                                <a href="#">Сместители</a>
                            </li>
                            <li>
                                <a href="#">Вибраторы FLOW</a>
                            </li>
                            <li>
                                <a href="#">Очистка сточных вод</a>
                            </li>
                            <li>
                                <a href="#">Энергетическое оборудование</a>
                            </li>
                        </ul>
                    </nav>-->
                            </ul>
                        </nav>
                </div>
                <div class="footer__men"><img src="{{asset('storage/footer-man.png')}}"/></div>
                <br>
                <div class="footer__addr footer_wam-label">
                    <h3><img src="{{asset('storage/number9.png')}}"/>Каталог продукции</h3>
                    <p>
                        Адрес:
                    <p>
                        350065 г.Москва, улица Панфилова,<br>
                        д.20, корпус 3, "Дельтапланерный клуб МАИ"
                    </p>
                    <br><br><br>
                    <div class="footer__info">
                        c 8 до 22 <span class="footer__label">без выходных</span><br>
                        <span class="footer__tel">8(495)989 67 89</span>
                        <a class="footer__back-call" href="#">Заказать звонок</a> &nbsp;&nbsp; <a class="footer__email" href="#">INFO@WAM.RU</a>
                    </div>
                    <div class="footer__copyright">
                        © 2017 Лидер <br> Технологическое <br> оборудование
                    </div>
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}" type="application/javascript"></script>
@yield('view.scripts')
</body>
</html>