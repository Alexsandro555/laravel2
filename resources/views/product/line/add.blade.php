@extends('layouts.master')

@if (!isset($line))
    @section('title', 'Добавление линейки продукции')
@else
    <?php $title = 'Редактирование линейки '.$line->title;?>
    @section('title', $title)
@endif

@section('content')
    @if (!isset($line))
        <h1>Добавление линейки продукции</h1>
    @else
        <h1>Редактирование линейки <?php echo $line->name; ?></h1>
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

    @if (isset($line))
        {!! Form::model($line, ['route' => ['update-line', $line->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'add-line', 'method' => 'post', 'files' => true]) !!}
    @endif
    <div class="form-group">
        {!! Form::label('type_product_id','Тип продукции') !!}
        @if(isset($line))
            {!! Form::select('type_product_id', $typeProducts, $line->type_product_id, ['placeholder' => 'Выберите тип продукции','class' => 'form-control']) !!}
        @else
            {!! Form::select('type_product_id', $typeProducts, null, ['placeholder' => 'Выберите тип продукции','class' => 'form-control']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('producer_id','Производитель') !!}
        @if(isset($line))
            {!! Form::select('producer_id', $producers, $line->producer_id, ['placeholder' => 'Выберите производителя','class' => 'form-control']) !!}
        @else
            {!! Form::select('producer_id', $producers, null, ['placeholder' => 'Выберите производителя','class' => 'form-control']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('name_line','Наименование линейки продукции') !!}
        {!! Form::text('name_line', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort','Сортировка') !!}
        {!! Form::text('sort', null, ['class' => 'form-control']) !!}
        @if(isset($file))
            <br>
            <img src="{{ asset('storage/'.$file->filename) }}" width="98px" height="173px"/>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('file','Изображение') !!}
        {!! Form::file('file') !!}
    </div>
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    {{link_to_route('list-line','К списку линеек продукции',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
    {{link_to_route('add-line','Новая',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
    {!! Form::token() !!}
    {!! Form::close() !!}
@stop