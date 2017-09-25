@extends('layouts.master')
@section('title', 'Установка атрибутов')
@section('content')
    <set-attribute v-bind:arr-type-products="{{$arrTypeProducts}}"></set-attribute>
@stop