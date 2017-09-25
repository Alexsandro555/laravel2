@extends('layouts.master')

@section('title', 'Новости')

@section('content')
    <h1>Новости</h1>
    <table class="table table-hover table-bordered">
        <thead class="thead-inverse">
        <th>#</th>
        <th>Заголовок</th>
        <th>Url</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($news as $new)
            <tr>
                <td class="col-xs-0.5" scope="row">{{ $new->id }}</td>
                <td class="col-xs-4" scope="row"><a href="{{route('update-news',['id'=>$new->id])}}">{{ $new->title }}</a></td>
                <td class="col-xs-0.5" scope="row">{{ $new->url_key }}</td>
                <td class="col-xs-1">
                    <a href="{{route('update-news',['id'=>$new->id])}}" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="{{route('delete-news',['id' => $new->id])}}" type="button" class="btn btn-danger btn-sm" ><i class="fa fa-minus"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('add-news')}}" class="btn btn-primary">Добавить</a>
    <a href="{{route('list-categories',['id' => 1])}}" class="btn btn-info">К спииску продукции</a>
@section('view.scripts')

@endsection
@stop