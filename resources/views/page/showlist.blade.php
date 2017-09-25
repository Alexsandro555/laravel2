@extends('layouts.master')

@section('title', 'Список страниц')

@section('content')
    <h1>Список страниц</h1>
    <table class="table table-hover table-bordered">
        <thead class="thead-inverse">
        <th>#</th>
        <th>Заголовок страницы</th>
        <th>URL-адрес</th>
        <th>Содержимое страницы</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td class="col-xs-0.5" scope="row">{{ $page->id }}</td>
                <td class="col-xs-4" scope="row"><a href="{{route('show-page', ['id'=>$page->id])}}">{{ $page->name }}</a></td>
                <td class="col-xs-1.5" scope="row">{{ $page->url_key }}</td>
                <td class="col-xs-5" scope="row">{!! $page->content !!} </td>
                <td class="col-xs-1">
                    <a href="{{route('update-page',['id'=>$page->id])}}" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="{{route('delete-page',['id' => $page->id])}}" type="button" class="btn btn-danger btn-sm" ><i class="fa fa-minus"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        <div style="float: left;: left">
            <a href="{{route('add-page')}}" type="buttons" class="btn btn-info">Добавить</a>
        </div>
        <div style="float:right">{{ $pages->links() }}</div>
        <div style="clear:both"></div>
    </div>
@section('view.scripts')

@endsection
@stop