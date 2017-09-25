@extends('layouts.master')

@if (!isset($catalog))
    @section('title', 'Добавление нового каталога')
@else
    <?php $title = 'Обновление каталога '.$catalog->title;?>
    @section('title', $title)
@endif

@section('content')
    @if (!isset($catalog))
        <h1>Добавление нового каталога</h1>
    @else
        <h1>Редактирование каталога <?php echo $catalog->name; ?></h1>
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
    @if (isset($catalog))
        {!! Form::model($catalog, ['route' => ['update-catalog', $catalog->id]]) !!}
    @else
        {!! Form::open(['route' => 'add-catalog', 'method' => 'post']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('title','Название каталога') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('url_key','URL-адрес') !!}
        {!! Form::text('url_key', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description','Описание') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort','Сортировка') !!}
        {!! Form::number('sort', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('active','Активен') !!}
        @if(isset($catalog))
        {!! Form::checkbox('active', null, true) !!}
        @else
        {!! Form::checkbox('active', null, false) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('parent','Родительский каталог') !!}
        {!! Form::select('parent', $parent_catalog, null, ['placeholder' => 'Выберите родительский каталог для текущего','class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Добавить', ['class' => 'btn btn-primary']) !!}
    {{link_to_route('showlist-page','Назад к списку',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
    {!! Form::token() !!}
    {!! Form::close() !!}
@stop

@section('view.scripts')

@stop