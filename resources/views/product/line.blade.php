@extends('layouts.master')
@section('title', 'Линиейка продукции')
@section('content')
    <product-line2 v-bind:elements-arr="{{json_encode($resultArr)}}"></product-line2>
@stop
