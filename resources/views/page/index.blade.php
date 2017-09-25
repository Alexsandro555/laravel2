@extends('layouts.master')

@section('title', $page->name)

@section('content')
    <h1>{{$page->name}}</h1>
    {{$page->content}}
@stop