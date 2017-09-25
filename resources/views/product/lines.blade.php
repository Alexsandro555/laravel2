@extends('layouts.master')
@section('title', 'Линейка продукции')
@section('content')
    <product-lines v-bind:arr-producers="{{json_encode($arrProducers)}}" v-bind:arr-type-products="{{json_encode($arrTypeProducts)}}" v-bind:arr-producer-type-products="{{json_encode($arrProducerTypeProducts)}}"></product-lines>
@stop
