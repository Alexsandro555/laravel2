@extends('layouts.master')


@if (!isset($typeProduct))
    @section('title', 'Добавление нового типа продукции')
@else
    <?php $title = 'Редактирование типа продукции '.$typeProduct->title;?>
    @section('title', $title)
@endif


@section('content')
    @if (!isset($typeProduct))
        <h1>Добавление нового типа продукции</h1>
    @else
        <h1>Редактирование типа продукции: <?php echo $typeProduct->title; ?></h1>
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

    @if (isset($typeProduct))
        {!! Form::model($typeProduct, ['route' => ['type-product-update', $typeProduct->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'type-product-add', 'method' => 'post', 'files' => true]) !!}
    @endif
    <div class="form-group">
        {!! Form::label('title','Название типа продукта') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tnved_id','Товарный номер вида экономической деятельности') !!}
        @if(isset($typeProduct))
            {!! Form::select('tnved_id', $tnved, $typeProduct->tnved_id, ['placeholder' => 'Выберите товарный номер вида экономической деятельности','class' => 'form-control']) !!}
        @else
            {!! Form::select('tnved_id', $tnved, null, ['placeholder' => 'Выберите товарный номер вида экономической деятельности','class' => 'form-control']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('description','Описание') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'desc-ckeditor']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort','Сортировка') !!}
        {!! Form::text('sort', null, ['class' => 'form-control']) !!}
        @if(isset($file))
            <br>
            <img src="{{ asset('storage/'.$file->filename) }}" width="72px" height="89px"/>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('file','Изображение') !!}
        {!! Form::file('file') !!}
    </div>
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    {{link_to_route('list-type-product','К списку типов',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
    {{link_to_route('type-product-add','Новый',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
    {!! Form::token() !!}
    {!! Form::close() !!}
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


