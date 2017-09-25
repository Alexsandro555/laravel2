@extends('layouts.master')
@section('title', 'Добавление атрибута')
@section('content')
    @if(isset($attributes))
        <add-attribute :exist-attr="{{ $attributes->toJson() }}" v-bind:arr-type-products="{{$arrTypeProducts}}"></add-attribute>
    @else
        <add-attribute v-bind:arr-type-products="{{$arrTypeProducts}}"></add-attribute>
    @endif
@stop