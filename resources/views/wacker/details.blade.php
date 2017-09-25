@extends('layouts.wacker')


@section('content-item')
    <div class="detail">
        <div>
            <p class="breadrcumbs detail-broadrcubms">
                Главная <img src="{{asset('css/wacker/img/breadcrumbs.png')}}" class="breadrcumbs-img"> Внутреняя
            </p>

        </div>
        <div class="sd">
            <div class="detail-picture">
                <div class="detail__images">
                    <div class="detail-images-center">

                    </div>
                </div>
                <div class="clear"></div>
                <div>
                    <carousel name="carousel4" style="width: 270px; height: 100px; margin-left: 20px;"  :pagination-enabled=false :navigation-enabled=true :per-page=3  :per-page-custom="[[480, 3], [768, 3]]">
                        <slide><div class="carousel-slide">1</div></slide>
                        <slide><div class="carousel-slide">2</div></slide>
                        <slide><div class="carousel-slide">3</div></slide>
                        <slide><div class="carousel-slide">4</div></slide>
                    </carousel>
                </div>

            </div>
            <div class="detail-data">
                <div class="detail__header">
                    <div class="detail__title">
                        <h1>Многовальные шнековые питатели</h1>
                    </div>
                    <div class="detail__IEC">
                        арт. 51000010533
                    </div>
                </div>

                <div class="detail__characteristics">
                    <table class="detail__table">
                        <thead>
                        <th class="table__main">Характеристики</th>
                        <th></th>
                        <th></th>
                        <th class="table__kol"></th>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td rowspan="4"><span>23800</span> руб.</td>
                            <td rowspan="4" width="60px">
                                <div class="detail-counter">
                                    <div class="detail-counter__left"><img src="{{asset('css/wacker/img/detail-cart-arr-down.png')}}"/></div>
                                    <div class="detail-counter__center">3</div>
                                    <div class="detail-counter__right"><img src="{{asset('css/wacker/img/detail-cart-arr-up.png')}}"/></div>
                                </div>
                            </td>
                            <td rowspan="4" class="table__sale">
                                <a href="#" class="table__btn">Купить</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Диаметры винта (150мм 600мм)</td>
                        </tr>
                        <tr>
                            <td>До 6 винтов в одном лотке</td>
                        </tr>
                        <tr>
                            <td>Размеры лотка от 1500 мм до 4000мм</td>
                        </tr>
                        <tr>
                            <td>Нет образования затворов</td>
                        </tr>
                        </tbody>
                    </table><br>
                    <div class="tech-catalog">
                        <ul>
                            <li>Технический каталог 2</li>
                        </ul>
                    </div>
                    <div class="tech-catalog">
                        <ul>
                            <li>Технический каталог 3</li>
                            <li>Технический каталог 4</li>
                        </ul>
                    </div>
                    <div class="characteristics-list">
                        <ul>
                            <li>Высокочастотный глубинный вибратор IEC 38/230/5/15</li>
                            <li>Диаметр булавы 38 мм, длина булавы 285 мм, длина вала 5 метров</li>
                            <li>Подключение к обычной розетке на 220 V~ (1 фаза)</li>
                            <li>Проверенное качество от немецкого производителя Wacker Neuson</li>
                            <li>Для уплотнения бетона с воздействием вибрации высокой частоты</li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="detail-characteristics-info-wrapper">
                <div class="detail-characteristics-info">
                    <div class="detail-characteristics-info__header">
                        <ul>
                            <li><a href="#">Технические характеристики</a></li>
                            <li><a href="#">Описание</a></li>
                            <li><a href="#">Подробнее</a></li>
                            <li><a href="#">Отзывы</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="banner detail-marg">
                <div class="banner__text">
                    <span class="banner__header">Специальное оборудование</span><br>
                    <span class="banner__subheader">Для строительства</span>
                </div>
                <a href="#" class="detail-button">Подробнее</a>
            </div>
        </div>
    </div>
@stop

@section('content')

@stop

@section('view.scripts')
    <script>
        $(document).ready(function() {
            $('.content').addClass('no-background');
        });
        $(document).ready(function()
        {
            $('.menu-left__toggle').html('РАЗВЕРНУТЬ');
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
@stop