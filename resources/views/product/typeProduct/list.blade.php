@extends('layouts.master')

@section('title', 'Типы продукции')

@section('content')
    <h1>Типы продукции</h1>
    <table class="table table-hover table-bordered">
        <thead class="thead-inverse">
        <th>#</th>
        <th>Название</th>
        <th>Сорт.</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($typeProducts as $typeProduct)
            <tr>
                <td class="col-xs-0.5" scope="row">{{ $typeProduct->id }}</td>
                <td class="col-xs-4" scope="row"><a href="{{route('type-product-update',['id'=>$typeProduct->id])}}">{{ $typeProduct->title }}</a></td>
                <td class="col-xs-0.5" scope="row">{{ $typeProduct->sort }}</td>
                <td class="col-xs-1">
                    <a href="{{route('type-product-update',['id'=>$typeProduct->id])}}" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('type-product-add')}}" class="btn btn-primary">Добавить</a>
    <a href="{{route('list-categories',['id' => 1])}}" class="btn btn-info">К спииску продукции</a>
@section('view.scripts')

@endsection
@stop