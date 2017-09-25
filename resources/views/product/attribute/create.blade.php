@extends('layouts.master')


@if (!isset($attribute))
    @section('title', 'Добавление нового атрибута')
@else
    <?php $title = 'Редактирование атрибута '.$attribute->title;?>
    @section('title', $title)
@endif


@section('content')
    @if (!isset($attribute))
        <h1>Добавление нового атрибута</h1>
    @else
        <h1>Редактирование атрибута <?php echo $attribute->name; ?></h1>
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

    @if (isset($attribute))
        {!! Form::model($attribute, ['route' => ['update-attribute', $attribute->id]]) !!}
    @else
        {!! Form::open(['route' => 'create-attribute', 'method' => 'post']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('title','Название атрибута') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort','Сортировка') !!}
        {!! Form::text('sort', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('alias','Алиас') !!}
        {!! Form::text('alias', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    {!! Form::token() !!}
    {!! Form::close() !!}
@stop