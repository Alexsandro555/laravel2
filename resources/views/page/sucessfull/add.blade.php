@extends('layouts.master')

@section('title', 'Страница успешно добавлена')

@section('content')
    <h1>Страница c id <?php if(isset($id)) {echo $id; } ?> успешно создана</h1>
@stop