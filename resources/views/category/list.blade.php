@extends('layouts.master')

@section('title', 'Каталог')

@section('content')
    <div>
        <h2>Действия:</h2>
        <div style="float: left; width: 79%">

            <div class="panel panel-default">
                <div class="panel-heading">Линейка продукции</div>
                <div class="panel-body">
                    <a href="{{route('add-product')}}" class="btn btn-info">Добавить новый продукт</a>

                    <div class="btn-group btn-group">
                        <a href="{{route('tnved-csv')}}" class="btn btn-info">Загрузить ТНВЭД</a>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Тип продукции
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('type-product-add')}}">Добавить</a></li>
                                <li><a href="{{route('list-type-product')}}">Список</a></li>
                            </ul>
                        </div>
                        <a href="{{route('add-producer')}}" class="btn btn-info">Добавить производителя</a>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Линейка продукции
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('add-line')}}">Добавить</a></li>
                                <li><a href="{{route('list-line')}}">Список</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Атрибуты</div>
                <div class="panel-body">
                    <div class="btn-group btn-group">

                        <a href="{{route('create-attribute')}}" class="btn btn-info">Создать аттрибут</a>
                        <a href="{{route('set-attributes')}}" class="btn btn-info">Привязка атрибутов</a>
                        <a href="{{route('set-prodLine-attributes')}}" class="btn btn-info">Привязка линейки атрибутов</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    <h2>Каталог</h2>
    <div class="row">
        <div class="col-lg-6">
            {!! Form::open(['route' => 'find-product', 'method' => 'post']) !!}
            <div class="input-group">
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Поиск по наименованию...']) !!}
                <span class="input-group-btn">
                 <button class="btn btn-default" type="submit">Поиск</button>
                </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        {!! Form::token() !!}
        {!! Form::close() !!}
    </div>
    <br>
    <table class="table table-hover table-bordered">
        <thead class="thead-inverse">
        <th>#</th>
        <th>Заголовок</th>
        <th>URL-адрес</th>
        <th>Описание</th>
        <th>Актив.</th>
        <th>Сорт.</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td class="col-xs-0.5" scope="row">{{ $category->id }}</td>
                <td class="col-xs-3.5" scope="row"><i class="fa fa-folder" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a href="{{route('list-categories',['id'=>$category->id])}}">{{ $category->title }}</a></td>
                <td class="col-xs-2" scope="row">{{ $category->url_key }}</td>
                <td class="col-xs-4" scope="row">{{ $category->description }}</td>
                <td class="col-xs-0.5" scope="row">{{ $category->active }}</td>
                <td class="col-xs-0.5" scope="row">{{ $category->sort }}</td>
                <td class="col-xs-2">
                    <a href="{{route('update-category',['id'=>$category->id])}}" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="{{route('delete-category',['id' => $category->id])}}" type="button" class="btn btn-danger btn-sm" ><i class="fa fa-minus"></i></a>
                </td>
            </tr>
        @endforeach
        @foreach($products as $product)
            <tr>
                <td class="col-xs-0.5" scope="row">{{ $product->id }}</td>
                <td class="col-xs-3.5" scope="row"><a href="{{route('update-product',['id'=>$product->id])}}">{{ $product->title }}</a></td>
                <td class="col-xs-2" scope="row">{{ $product->url_key }}</td>
                <td class="col-xs-4" scope="row">
                    <?php
                        if(strlen($product->description) > 200)
                        {
                            echo substr($product->description,0,200)."...";
                        }
                        else
                        {
                            echo $product->description;
                        }
                    ?>
                </td>
                <td class="col-xs-0.5" scope="row">{{ $product->active }}</td>
                <td class="col-xs-0.5" scope="row">{{ $product->sort }}</td>
                <td class="col-xs-2">
                    <a href="{{route('update-product',['id'=>$product->id])}}" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="{{route('delete-product',['id' => $product->id])}}" type="button" class="btn btn-danger btn-sm" ><i class="fa fa-minus"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="float:left; width: 78%"></div>
    <div style="float:right; width: 100%; text-align: right">{{ $products->links() }}</div>
    <div style="clear:both"></div>


@section('view.scripts')

@endsection
@stop