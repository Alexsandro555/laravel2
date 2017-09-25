@extends('layouts.wacker')

@section('content-item')
    <div class="content__header">
    </div>
    <p style="padding-left: 500px; font-size: 2.4em">Новости</p>

    @foreach($news as $new)
        <div class="news">
            <div class="news__date">
                12.08.17
            </div>
            <div class="news__image">
                @foreach($new->files as $file)
                    <img src="{{asset('../storage/'.$file->filename)}}" width="400px" height="300"/>
                @endforeach
            </div>
            <div class="news__content">
                <a href="{{route('show-news',['slug' => $new->url_key])}}">{{$new->title}}</a>
                <p>
                    {{strip_tags($new->content)}}
                </p>
            </div>
        </div>
    @endforeach
    <div>&nbsp</div>
@stop

@section('content')

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