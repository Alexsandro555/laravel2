@extends('layouts.wacker')

@section('title', $typeProduct->title)

@section('content-item')
    <div class="content__catalog">
        <div class="content__catalog-head">
            <p class="breadrcumbs">
                Главная <img src="{{asset('storage/breadcrumbs.png')}}" class="breadrcumbs-img"> Внутреняя
            </p>
            <div class="content__header">
                <h2><img src="{{asset('storage/number2.png')}}"/>{{$typeProduct->title}}</h2>
            </div>
            <p>
                {!! $typeProduct->description !!}
            </p>
        </div>
        <div class="content__catalog-wam">
            <div class="wamgroup content__catalog-mrg">
                <img src="{{asset('storage/wamgroup.png')}}">
                <a href="#">Посетить официальный сайт</a>
            </div>
        </div>
        <div class="clear"></div>
        <div class="content__product-all-btn"><a class="btn-detail content__all-botton" href="#">Все хиты</a></div>
        <?php $firstProductLines = array_shift($productLine); ?>
        @if ($firstProductLines)
            <div>
                @foreach($firstProductLines["products"] as $firstProductLine)
                    <div class="product-wrapper">
                        <div class="product">
                            <div class="product-image">
                                @if(count($firstProductLine->files)>0)
                                    @foreach($firstProductLine->files as $file)
                                        @if($file->typeFile->name == "listimage")
                                            <img src="{{asset('../storage/'.$file->config["filename"])}}"/>
                                            <?php break; ?>
                                        @endif
                                    @endforeach
                                @else
                                    <img src="{{asset('../storage/no-image.png')}}" width="170px"/>
                                @endif
                            </div>
                            <div class="product-name"><a href="{{route('wacker-detail',['slug'=>$firstProductLine->url_key])}}">
                                    {!! str_limit($firstProductLine->title, $limit = 50, $end="...") !!}
                                </a>
                            </div>
                            <div class="product-desc">
                                Сделан на заказ из стандартных компонентов
                                <hr class="product-hr">
                                <div>
                                    <span class="product-price">{{$firstProductLine->price}}</span> <span class="product-rub">руб.</span>
                                    <img @click.prevent="addCart({{$firstProductLine->id}})" src="{{asset('storage/product-cart.png')}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@stop

@section('content')
    <?php $secondProductLines = array_shift($productLine); ?>
    @if ($secondProductLines)
        <div class="sub-catalog-wrapper">
            <div class="sub-catalog">
                <div class="sub-catalog__content">
                    <div class="sub-catalog-header">
                        <h2><img src="{{asset('storage/number3.png')}}"/>{{$secondProductLines["title"]}}</h2>
                        <div>
                            @foreach($secondProductLines["products"] as $secondProductLine)
                                <div class="sub-catalog__product">
                                    <div class="wrap">
                                        <div class="sub-catalog__product-image">
                                            @if(count($secondProductLine->files)>0)
                                                @foreach($secondProductLine->files as $file)
                                                    <img src="{{asset('../storage/'.$file->filename)}}" width="170px"/>
                                                    <?php break; ?>
                                                @endforeach
                                            @else
                                                <img src="{{asset('../storage/no-image.png')}}" width="170px"/>
                                            @endif
                                        </div>
                                        <div class="sub-catalog__product-title">
                                            <a href="{{route('wacker-detail',['slug'=>$secondProductLine->url_key])}}">
                                                {!! str_limit($secondProductLine->title, $limit = 50, $end="...") !!}</a>
                                        </div>
                                        <div class="sub-catalog-product-desc">
                                            Сделан на заказ из стандартных компонентов
                                            <hr class="product-hr">
                                            <span class="sub-catalog-product-price">{{$secondProductLine->price}}</span>
                                            <span class="sub-catalog-product-rub">руб.</span>
                                            <img @click.prevent="addCart({{$secondProductLine->id}})" src="{{asset('storage/product-cart.png')}}"/>
                                        </div>
                                        <div class="sub-catalog__adv-info">
                                            {!! str_limit(strip_tags($secondProductLine->description), $limit = 150, $end="...") !!}
                                            <br>
                                            <a class="btn-detail sub-catalog-product-btn" href="{{route('wacker-detail',['slug'=>$firstProductLine->url_key])}}">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif



    <?php $thirdProductLines = array_shift($productLine); ?>
    @if ($thirdProductLines)
        <div class="second-product">
            <div class="second-product-wrapper">
                <div class="second-product__content">
                    <div class="wam-news">
                        <h2><img src="{{asset('storage/number4.png')}}"/>НОВОСТИ КОМПАНИИ</h2>
                        @foreach($news as $new)
                            <div class="wam-news__item">
                                <div class="wam-news__date">{{$new->updated_at}}</div>
                                <a href="{{route('show-news',['id' => $new->url_key])}}">{{$new->title}}</a><br>
                                {!! str_limit(strip_tags($new->content), $limit = 150, $end="...") !!}
                            </div>
                        @endforeach
                        <div class="wam-news__link">
                            <a class="wam-news__button" href="#">ВСЕ НОВОСТИ</a>
                        </div>
                    </div>
                    <div class="wam__carousel">
                        <div class="wam__header">
                            <h2><img src="{{asset('storage/wam-slider-point.png')}}" />{{$thirdProductLines["title"]}}</h2>
                        </div>
                        <leader-slider per-page="3" :url="'/product-line/{{$thirdProductLines["id"]}}'"></leader-slider>

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
                        */?>

                    </div>
                </div>
            </div>
        </div>
    @endif

    <?php $fourProductLines = array_shift($productLine); ?>
    @if ($fourProductLines)
    <div class="product-line-1-wrapper">
        <div class="product-line-1">
            <div class="product-line-1__header-catalog">
                <h2><img src="{{asset('storage/number4.png')}}"/>{{$fourProductLines["title"]}}</h2>
            </div>
            <leader-slider :perpage=4 :url="'/product-line/{{$fourProductLines["id"]}}'"></leader-slider>
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
            </div>  */ ?>
        </div>
    </div>
    @endif
    <div class="catalog-description-wrapper">
        <div class="catalog-description">
            <?php //<img src="{{asset('css/wacker/img/catalog-description-polygon3.png')}}"/>?>
            <div class="catalog-text">
                <h2>На сегодняшний день данная группа оборудования делится на:</h2>
                <p>
                    Глубинные вибраторы для бетона с электромеханическим приводом (серия HMS)<br>
                    Погружные высокочастотные для уплотнения бетона (серия IREN, IRFU) <br>
                    Внешние для опалубки (серия AR)
                </p>
                <h2>Глубинные вибраторы для бетона с электромеханическим приводом серия (HMS)</h2>
                HMS - система из электромеханического привода, гибкого вала и вибробулавы. Это трехсоставной механизм, где каждый элемент имеет свой артикул
                и при необходимости вал или булава могут заменяться. Приводы выпускаются разной мощьности от 1 до 2.1 кВт, валы разных длин от 1 до 9 метров,
                и наконец булавы разного диаметра от 25 до 65 мм. Системы креплений на приводах M1500 и M2500 унифицированны с валами SM3, SM4, SM5, SM7. Привод M1000
                выпускается для особых валов и булав, меньшей длины и диаметра соответственно. Приводы M2500 считаются самыми надежными (в линейке бренда), так как
                имеют хороший запас мощности и обмотку высокого класса. Даже при длительной эксплуатации такой привод сохраняет оптимальные показатели и эффективно
                передает вращательное движение через гибкий вал в вибробулаву.
                <h2>Погружные высокочастотные вибраторы для уплотнения бетона (серия IREN, IRFU)</h2>
                HMS - система из электромеханического привода, гибкого вала и вибробулавы. Это трехсоставной механизм, где каждый элемент имеет свой артикул
                и при необходимости вал или булава могут заменяться. Приводы выпускаются разной мощьности от 1 до 2.1 кВт, валы разных длин от 1 до 9 метров,
                и наконец булавы разного диаметра от 25 до 65 мм. Системы креплений на приводах M1500 и M2500 унифицированны с валами SM3, SM4, SM5, SM7. Привод M1000
                выпускается для особых валов и булав, меньшей длины и диаметра соответственно. Приводы M2500 считаются самыми надежными (в линейке бренда), так как
                имеют хороший запас мощности и обмотку высокого класса. Даже при длительной эксплуатации такой привод сохраняет оптимальные показатели и эффективно
                передает вращательное движение через гибкий вал в вибробулаву.
            </div>
        </div>
    </div>
    @stop

    @section('view.scripts')
    <script>
        $(document).ready(function()
        {
            $('.menu-left__toggle').html('РАЗВЕРНУТЬ');
            $(".menu-left__toggle").addClass('rolldown');
            $('.menu-left ul').toggle('normal');
            $('.menu-left__toggle').click(function () {
                $(this).parent().children('ul').toggle('normal');
                if(this.innerHTML == 'РАЗВЕРНУТЬ') {
                    this.innerHTML = 'СВЕРНУТЬ';
                    $(".menu-left__toggle").addClass('rollup');
                    $(".menu-left__toggle").removeClass('rolldown');
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