@extends('layouts.wacker')

@section('content-item')
        <div class="detail">
            <div>
                <p class="breadrcumbs detail-broadrcubms">
                    Главная <img src="{{asset('../storage/breadcrumbs.png')}}" class="breadrcumbs-img"> Внутреняя
                </p>
            </div>
            <div class="sd">
                <div class="detail-picture">
                    <leader-detail-image :url="'/product-images/{{$product->id}}'"></leader-detail-image>
                </div>
                <div class="detail-data">
                    <div class="detail__header">
                        <div class="detail__title">
                            <h1>{{$product->title}}</h1>
                        </div>
                        <div class="detail__IEC">
                            @if($product->article)
                                арт. {{$product->article}}
                            @endif
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
                                        <div class="detail-counter__left" @click.prevent="Qty>0?Qty--:Qty=0"><img src="{{asset('../storage/detail-cart-arr-down.png')}}"/></div>
                                        <div class="detail-counter__center">@{{ Qty }}</div>
                                        <div class="detail-counter__right" @click.prevent="Qty++"><img src="{{asset('../storage/detail-cart-arr-up.png')}}"/></div>
                                    </div>
                                </td>
                                <td rowspan="4" class="table__sale">
                                    <a @click.prevent="addCart({{$product->id}})" href="#" class="table__btn">Купить</a>
                                </td>
                            </tr>
                            <?php $counter=1; ?>
                            @foreach($product->attributes as $attribute)
                                @if($attribute->pivot->value)
                                    <tr>
                                        <td>{{$attribute->title}}: {{$attribute->pivot->value}}</td>
                                    </tr>
                                    <?php $counter++; if($counter>3) break;?>
                                @endif
                            @endforeach
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
                                <li><span class="detail-characteristics__btn-tech" href="#" v-bind:class="{detailActive: CharacteristicActive}" @click="tabActive('CharacteristicActive')">Технические характеристики</span></li>
                                <li><span class="detail-characteristics__btn-tech" v-bind:class="{detailActive: DescriptionActive}" @click="tabActive('DescriptionActive')" href="#">Описание</span></li>
                                <li><span class="detail-characteristics__btn-tech" v-bind:class="{detailActive: DetailActive}" @click="tabActive('DetailActive')" href="#">Подробнее</span></li>
                            </ul>
                            <div class="detail-characteristics-marg" v-if="CharacteristicActive == true">
                                <div class="detail-characteristics__left-table">
                                    <table class="detail-characteristics__table">
                                        <tbody>
                                        <?php $counter=1; ?>
                                        @foreach($product->attributes as $attribute)
                                            @if($attribute->pivot->value)
                                                <tr>
                                                    <td>{{$attribute->title}}</td>
                                                    <td  class="tbl-left">{{$attribute->pivot->value}}</td>
                                                </tr>
                                                <?php
                                                $counter++;
                                                if($counter>9)
                                                {
                                                    echo "</tbody></table></div><div class='detail-characteristics__right-table'><table class='detail-characteristics__table'><tbody>";
                                                    $counter=1;
                                                }
                                                ?>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="detail-characteristics__description detail-characteristics-marg" v-if="DescriptionActive == true">
                                {!! $product->description !!}
                            </div>
                            <div class="clear"></div>
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



