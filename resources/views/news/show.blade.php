@extends('layouts.wacker')
@section('content-item')
    <div class="content__header">
    </div>
    <p style="text-align: center; font-size: 2.4em">{{$news->title}}</p>
        <br>
        @foreach($news->files as $file)
            <img src="{{ asset('storage/'.$file->filename) }}" class="news-img" width="300px" height="250px"/>
        @endforeach
    <p>
        {!! $news->content !!}
    </p>
    <div class="clear">&nbsp</div>
@stop
@section('view.scripts')
    <script>
        $(document).ready(function()
        {
            $('.menu-left ul').toggle('normal');
            $('.menu-left__toggle').html('РАЗВЕРНУТЬ');
            $('.menu-left__toggle').click(function () {
                $(this).parent().children('ul').toggle('normal');
                if(this.innerHTML == 'РАЗВЕРНУТЬ') {
                    this.innerHTML = 'СВЕРНУТЬ';
                    $(".menu-left__toggle").addClass('rollup');
                }
                else
                {
                    this.innerHTML = 'РАЗВЕРНУТЬ';
                    $(".menu-left__toggle").removeClass('rollup');
                }
                return false;
            });
        });
    </script>
@stop