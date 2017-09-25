@extends('layouts.master')

@section('title', 'Линейка продукции')

@section('content')
    <h1>Линейка продукции</h1>
    <table class="table table-hover table-bordered">
        <thead class="thead-inverse">
        <th>#</th>
        <th>Название</th>
        <th>Сорт.</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($producerTypeProducts as $producerTypeProduct)
            <tr>
                <td class="col-xs-0.5" scope="row">{{ $producerTypeProduct->id }}</td>
                <td class="col-xs-4" scope="row"><a href="{{route('update-line',['id'=>$producerTypeProduct->id])}}">{{ $producerTypeProduct->name_line }}</a></td>
                <td class="col-xs-0.5" scope="row">{{ $producerTypeProduct->sort }}</td>
                <td class="col-xs-1">
                    <a href="{{route('update-line',['id'=>$producerTypeProduct->id])}}" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('add-line')}}" class="btn btn-primary">Добавить</a>
    <a href="{{route('list-categories',['id' => 1])}}" class="btn btn-info">К спииску продукции</a>
@section('view.scripts')

@endsection
@stop