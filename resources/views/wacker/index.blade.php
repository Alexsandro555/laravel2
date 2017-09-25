@extends('layouts.wacker')

@section('content-item')
    <div class="banner">
        <div class="banner__text">
            <span class="banner__header">Специальное оборудование</span><br>
            <span class="banner__subheader">Для строительства</span>
        </div>
        <a href="#" class="detail-button">Подробнее</a>
    </div>

    <div class="content__products">
        <div class="content__product-header">
            <span class="content__product-title"><img src="{{asset('storage/number2.png')}}"/>Хиты продаж</span>
        </div>
        <div class="content__product-button">
            <a href="#">Все хиты</a>
        </div>
        <div class="clear"></div>
        <leader-slider :perpage=3 :url="'/special-product/'"></leader-slider>
        <?php /*<div class="product-wrapper">
            <div class="product">
                <div class="product-image">
                    <img src="{{asset('storage/product-photo.png')}}" />
                </div>
                <div class="product-name"><a href="#">Винтовой конвейер</a></div>
                <div class="product-desc">
                    Сделан на заказ из стандартных компонентов
                    <hr class="product-hr">
                    <div>
                        <span class="product-price">145 800</span> <span class="product-rub">руб.</span>
                        <img src="{{asset('storage/product-cart.png')}}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="product">
                <div class="product-image">
                    <img src="{{asset('storage/product-photo.png')}}" />
                </div>
                <div class="product-name"><a href="#">Многовальные шнековые питатели</a></div>
                <div class="product-desc">
                    Сделан на заказ из стандартных компонентов
                    <hr class="product-hr">
                    <span class="product-price">145 800</span> <span class="product-rub">руб.</span>
                    <img src="{{asset('storage/product-cart.png')}}"/>
                </div>
            </div>
        </div>

        <div class="product-wrapper">
            <div class="product">
                <div class="product-image">
                    <img src="{{asset('storage/product-photo.png')}}" />
                </div>
                <div class="product-name"><a href="#">Винтовой конвейер</a></div>
                <div class="product-desc">
                    Сделан на заказ из стандартных компонентов
                    <hr class="product-hr">
                    <span class="product-price">145 800</span><span class="product-rub"> руб.</span>
                    <img src="{{asset('storage/product-cart.png')}}"/>
                </div>
            </div>
        </div>*/ ?>
    </div>
    <div class="wamgroup wam-marg">
        <img src="{{asset('storage/wamgroup.png')}}">
        <a href="#">Посетить официальный сайт</a>
    </div>
    <!--<div class="content__item">
        <div class="content__header">
            <h2>Наши акции и спецпредложения</h2>
            <img src="{{asset('css/wacker/img/gears-dark.png')}}" />
        </div>
        <button class="content-button">Смотреть все</button>
        <div class="main__content">
            <div class="content__text">
                <h2>Заголовок спецпредложения</h2>
                <p>Краткое описание акции или предложения, <br>создан для примера</p>
                <button class="back-call">ПОДРОБНЕЕ</button>
            </div>
        </div>
     </div>-->
@stop

@section('content')
    <div class="about">
        <div class="about-wrapper">
            <div class="about__content">
                <div class="about__info">
                    <span class="about__header"><img src="{{asset('storage/number3.png')}}"/>О компании</span>
                    <p>
                        Первый в мире работающий на нефти двигатель Дизеля был пущен в ход в 1899 году. Он
                        развавал 25 л.с. и затрачивал в час около четверти килограмма нефти на 1 л.с. Это был
                        важный успех, но заветной мечтой Нобеля было применение лизеля в качестве судовой
                        машины. В то время среди многих инженеров еще было распространено скептическое
                        отношение к дизелям. Большинство считало, что эти двигатели не годятся в качестве
                        привода для движения судов.
                    </p>

                    <span>Причины для этого были достаточно вескими.</span>
                    <ul>
                        <li>Во-первых, дизели не имели хода (реверса) и, установленные на корабле,
                            могли вращать винт только в одну сторону.</li>
                        <li>Во-вторых, первые дизели было невозможно запустить при некоторых крайних положениях поршня.</li>
                        <li>В третьих, работа дизелей с трудом поддавалась ругулировке - было трудно поменять
                            режим их работы, например, уменьшить или увеличить частоту вращения вала,
                            увеличивая или уменьшая тем самым скорость движения судна. </li>
                    </ul>

                    <a class="btn-detail" href="#">Подробнее</a>
                </div>
                <div class="about__news">
                    <span class="about__header"><img src="{{asset('storage/number4.png')}}"/>Новости</span>
                    <a class="btn-detail about-btn-right" href="#">Все новости</a>
                    <?php $news_count=1;?>
                    @foreach($news as $new)
                        <div class="about__news-left about__marg">
                            <h3><a href="{{route('show-news',['id' => $new->url_key])}}">{{$new->title}}</a></h3>
                            <div class="about__news-date">
                                {{$new->updated_at}}
                            </div>
                            <p>
                                <?php
                                if(strlen($new->content) > 50)
                                {
                                    echo strip_tags(substr($new->content,0,50))."...";
                                }
                                else {
                                    echo strip_tags($new->content);
                                }
                                ?>
                            </p>
                        </div>
                        <?php
                            $news_count++;
                            if($news_count>2) break;
                        ?>
                    @endforeach
                    <div class="about__marg">
                        <span class="about__header"><img src="{{asset('storage/number5.png')}}"/>Акция</span>
                        <div class="about__product">
                            <div class="about__product-detail">
                                <br><br>
                                <span>TECU - модульный фильтр</span>
                                <hr class="about__product-hr" align="left">
                                До 21 мая со скидкой <span class="about__product-detail-p">12%</span><br>
                                <del>28 800</del> руб. <span class="about__product-price">23 800 руб.</span>
                                <img src="{{asset('storage/product-cart.png')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wam__wrapper">
        <div class="wam__wrapper-from">
            <div class="wam">
                <div class="wam__main-prod">
                    <h3 class="wam__head"><img src="{{asset('storage/number6.png')}}"/>Основные направления</h3>
                    <type-slider per-page="3" :url="'/type-product/'"></type-slider>
                    <!--<div>
                        <div class="wam__spec-prod">
                            <div class="wam__spec-prod-img">
                                <img src="{{asset('storage/wam-spec-prod-img.png')}}"/>
                            </div>
                            <span class="wam__spec-prod-title">Растворосместители</span>
                        </div>
                        <div class="wam__spec-prod">
                            <div class="wam__spec-prod-img">
                                <img src="{{asset('storage/wam-spec-prod-img.png')}}"/>
                            </div>
                            <span class="wam__spec-prod-title">Растворосместители</span>
                        </div>
                        <div class="wam__spec-prod">
                            <div class="wam__spec-prod-img">
                                <img src="{{asset('storage/wam-spec-prod-img.png')}}"/>
                            </div>
                            <span class="wam__spec-prod-title">Растворосместители</span>
                        </div>
                    </div>-->
                </div>
                <div class="wam__brends">
                    <h3 class="wam__head"><img src="{{asset('storage/number7.png')}}"/>Наши бренды</h3>
                    <div class="wam__our-brands"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('view.scripts')
    <script>
        /*$(document).ready(function() {
            $('.content').addClass('no-background');
        });*/
        /*$(document).ready(function()
        {
            $(".menu-left__toggle").addClass('rollup');
            //$('.menu-left ul').toggle('normal');
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
        });*/
        $(document).ready(function()
        {
            $('.menu-left__toggle').html('СВЕРНУТЬ');
            $(".menu-left__toggle").addClass('rollup');
            $('.menu-left__toggle').click(function () {
                $(this).parent().children('ul').toggle('normal');
                if(this.innerHTML == 'РАЗВЕРНУТЬ') {
                    this.innerHTML = 'СВЕРНУТЬ';
                    $(".menu-left__toggle").removeClass('rolldown');
                    $(".menu-left__toggle").addClass('rollup');
                }
                else
                {
                    this.innerHTML = 'РАЗВЕРНУТЬ';
                    $(".menu-left__toggle").removeClass('rollup');
                    $(".menu-left__toggle").addClass('rolldown');
                }
                return false;
            });
        });
    </script>
@stop