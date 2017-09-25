@extends('layouts.master')

@if (!isset($news))
    @section('title', 'Добавление новой новости')
@else
    <?php $title = 'Редактирование новости '.$news->name;?>
    @section('title', $title)
@endif

@section('content')
    @if (!isset($news))
        <h1>Добавление новой новости</h1>
    @else
        <h1>Редактирование новости <?php echo $news->name; ?></h1>
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

    @if (isset($news))
        {!! Form::model($news, ['route' => ['update-news', $news->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'add-news', 'method' => 'post', 'files' => true]) !!}
    @endif
    <div class="form-group">
        {!! Form::label('title','Заголовок новости') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content','Содержимое') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'ckeditor']) !!}
        @if(isset($file))
            <br>
            <img src="{{ asset('storage/'.$file->filename) }}" width="300px" height="250px"/>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('file','Изображение') !!}
        {!! Form::file('file') !!}
    </div>
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    {{link_to_route('showlist-page','Назад к списку',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}

    {!! Form::token() !!}
    {!! Form::close() !!}
@stop

@section('view.scripts')
    <script>

        $(document).ready(function(){
            CKEDITOR.replace('ckeditor', {
                language: 'ru'
            });
        });
    </script>
@stop
