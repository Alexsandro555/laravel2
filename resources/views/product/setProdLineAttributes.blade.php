@extends('layouts.master')
@section('title', 'Установка атрибутов')
@section('content')
    <set-prodline-attribute v-bind:arr-prodtype-products="{{$arrProducerTypeProducts}}"></set-prodline-attribute>
@stop