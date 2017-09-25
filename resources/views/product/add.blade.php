@extends('layouts.master')

@if (!isset($product))
    @section('title', 'Добавление нового продукта')
@else
    <?php $title = 'Редактирование продукта '.$product->title;?>
    @section('title', $title)
@endif

@section('content')

    @if (!isset($product))
        <h1>Добавление нового продукта</h1>
    @else
        <h1>Редактирование продукта <?php echo $product->name; ?></h1>
    @endif
    <br>

    <!-- Сообщения валидации -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--Конец сообщений валидации-->


    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#main" role="tab">Основные</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#attributes" role="tab">Атрибуты</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="main" role="tabpanel">
            <br>
            @if (isset($product))
                {!! Form::model($product, ['route' => ['update-product', $product->id]]) !!}
            @else
                {!! Form::open(['route' => 'add-product', 'method' => 'post']) !!}
            @endif
            <div class="form-group">
                {!! Form::label('title','Название продукта') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('article','Артикул') !!}
                {!! Form::text('article', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('IEC','IEC') !!}
                {!! Form::text('IEC', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price','Цена') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description','Описание') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'desc-ckeditor']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('qty','Количество') !!}
                {!! Form::number('qty', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sort','Сортировка') !!}
                {!! Form::number('sort', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {{Form::hidden('onsale', 0)}}
                {!! Form::label('onsale','Скидка') !!}
                @if(isset($product))
                   {!! Form::checkbox('onsale', true) !!}
                @else
                    {!! Form::checkbox('onsale', true, false) !!}
                @endif
            </div>
            <div class="form-group">
                {{Form::hidden('special', 0)}}
                {!! Form::label('special','Спецпредложение') !!}
                @if(isset($product))
                    {!! Form::checkbox('special', true) !!}
                @else
                    {!! Form::checkbox('special', true, false) !!}
                @endif
            </div>
            <div class="form-group">
                {{Form::hidden('need_order', 0)}}
                {!! Form::label('need_order','Необходимо заказывать') !!}
                @if(isset($product))
                    {!! Form::checkbox('need_order', true) !!}
                @else
                    {!! Form::checkbox('need_order', true, false) !!}
                @endif
            </div>
            <div class="form-group">
                {{Form::hidden('active', 0)}}
                {!! Form::label('active','Активен') !!}
                @if(isset($product))
                    {!! Form::checkbox('active', true) !!}
                @else
                    {!! Form::checkbox('active', true, false) !!}
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('category_id','Каталог') !!}
                @if(isset($product))
                    {!! Form::select('category_id', $category_all, $product->category_id, ['placeholder' => 'Выберите каталог для продукта','class' => 'form-control']) !!}
                @else
                    {!! Form::select('category_id', $category_all, null, ['placeholder' => 'Выберите каталог для продукта','class' => 'form-control']) !!}
                @endif
            </div>
            @if(isset($product))
                <product-line2 v-bind:elements-arr="{{json_encode($resultArr)}}" v-bind:default-type-product="{{$product->type_product_id?$product->type_product_id:0}}" v-bind:default-producer="{{$product->producer_id?$product->producer_id:0}}" v-bind:default-line="{{$product->producer_type_product_id?$product->producer_type_product_id:0}}"></product-line2>
            @else
                <product-line2 v-bind:elements-arr="{{json_encode($resultArr)}}"></product-line2>
            @endif
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
            {{link_to_route('list-categories','Назад к списку',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
            {!! Form::hidden('files_ids', "[]", ['id'=>'files-id']) !!}
            {!! Form::hidden('model', 'App\Product') !!}
            {!! Form::token() !!}
            {!! Form::close() !!}
            <div style="margin-top: 50px;">
                <uploader url="/upload" :element-id={{(isset($product))?$product->id:0}}></uploader>
            </div>
        </div>
        <div class="tab-pane" id="attributes" role="tabpanel">
            @if(isset($product))
                @if(isset($product->producer_type_product_id))
                    <attributes-product v-bind:items="attrProd" v-bind:product-id="{{$product->id}}" v-bind:producer-type-product-id="{{$product->producer_type_product_id}}"></attributes-product>
                @else
                    <attributes-product v-bind:items="attrProd" v-bind:product-id="{{$product->id}}" v-bind:type-product-id="{{$product->type_product_id}}"></attributes-product>
                @endif
            @else
                <attributes-product v-bind:items="attrProd"></attributes-product>
            @endif
        </div>
    </div>
@stop

@section('view.scripts')
    <script>

        $(document).ready(function(){
            CKEDITOR.replace('desc-ckeditor', {
                language: 'ru'
            });
        });
    </script>
@stop
