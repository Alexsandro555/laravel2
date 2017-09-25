@extends('layouts.master')

@section('title', "Загрузка CSV")

@section('content')
    <h1>Загрузка товарных наименований вида экономической деятельности</h1>

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


    {!! Form::open(['route' => 'csv-upload', 'method' => 'post', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('tnved','Файл tnved.csv') !!}
        {!! Form::file('tnved') !!}
        <br>
        {!! Form::submit('Отправить', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::token() !!}
    {!! Form::close() !!}
@stop

