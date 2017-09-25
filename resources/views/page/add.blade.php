@extends('layouts.master')

@if (!isset($page))
    @section('title', 'Добавление новой страницы')
@else
    <?php $title = 'Обновление страницы '.$page->name;?>
    @section('title', $title)
@endif

@section('content')
    @if (!isset($page))
        <h1>Добавление новой страницы</h1>
    @else
        <h1>Редактирование страницы <?php echo $page->name; ?></h1>
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

    @if (isset($page))
        {!! Form::model($page, ['route' => ['update-page', $page->id]]) !!}
    @else
        {!! Form::open(['route' => 'add-page', 'method' => 'post']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('name','Заголовок страницы') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('url_key','URL-адрес') !!}
        {!! Form::text('url_key', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content','Описание') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'ckeditor']) !!}
        <!--<ck-wysiwyg name="content"></ck-wysiwyg>-->
        <!--<wysiwyg name="content" v-model="myHTML"></wysiwyg>-->
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
