@extends('layouts.master')


@if (!isset($producer))
    @section('title', 'Добавление нового производителя')
@else
    <?php $title = 'Редактирование производителя '.$producer->title;?>
    @section('title', $title)
@endif


@section('content')
    @if (!isset($producer))
        <h1>Добавление нового производителя</h1>
    @else
        <h1>Редактирование производителя <?php echo $producer->name; ?></h1>
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

    @if (isset($producer))
        {!! Form::model($producer, ['route' => ['update-producer', $producer->id]]) !!}
    @else
        {!! Form::open(['route' => 'add-producer', 'method' => 'post']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('title','Наименование производителя') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort','Сортировка') !!}
        {!! Form::text('sort', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    {!! Form::token() !!}
    {!! Form::close() !!}
@stop