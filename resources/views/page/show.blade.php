@extends('layouts.master')

@section('title', $page->name)

@section('content')
    <style>
        dl {
            margin-bottom: 50px;
        }

        dl dt {
            background: #5f9be3;
            color:#fff;
            float:left;
            font-weight: bold;
            margin-right: 10px;
            padding: 5px;
            width:180px;
        }
        dl dd {
            margin: 2px 0;
            padding: 5px 0;
        }
    </style>
    <h1>Детальное содержимое</h1>
    <dl>
        <dt>id</dt><dd>{{$page->id}}</dd>
        <dt>Заголовок страницы</dt><dd>{{$page->name}}</dd>
        <dt>Содержимое страницы</dt><dd>{!! $page->content !!}</dd>
    </dl>
    {{link_to_route('showlist-page','Назад к списку',null,['type'=>'buttons', 'class'=>'btn btn-info'])}}
@stop