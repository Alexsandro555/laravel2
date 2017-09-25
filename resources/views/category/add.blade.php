@extends('layouts.master')

@if (!isset($category))
    @section('title', 'Добавление новой категории')
@else
    <?php $title = 'Обновление категории '.$category->title;?>
    @section('title', $title)
@endif

@section('content')
    @if (!isset($category))
        <h1>Добавление нового каталога</h1>
    @else
        <h1>Редактирование каталога <?php echo $category->name; ?></h1>
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
    @if (isset($category))
        {!! Form::model($category, ['route' => ['update-category', $category->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'add-category', 'method' => 'post', 'files' => true]) !!}
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
        {!! Form::label('image','Изображение') !!}
        {!! Form::file('image') !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort','Сортировка') !!}
        {!! Form::number('sort', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('active','Активен') !!}
        @if(isset($category))
            {!! Form::checkbox('active', $category->active, $category->active ? true : false) !!}
        @else
            {!! Form::checkbox('active', true, false) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('parent','Родительский каталог') !!}
        <dropbox v-bind:nameelement="'parent'" v-bind:parent="<?php echo (isset($category))?$category->parent:0; ?>" v-bind:placeholder="'Выберите родительский каталог'" v-bind:url="'/admin/category/getAllCategories/'"></dropbox>
    </div>
    {!! Form::submit('Добавить', ['class' => 'btn btn-primary']) !!}
    {{link_to_route('showlist-page','Назад к списку',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
    {!! Form::token() !!}
    {!! Form::close() !!}
@stop

@section('view.scripts')

@stop