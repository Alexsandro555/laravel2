@extends('layouts.wacker')
@section('content-item')
    <leader-cart :cart-items="{{json_encode($arr)}}"></leader-cart>
@stop
@section('view.scripts')
    <script>
        $(document).ready(function()
        {
            $('.menu-left__toggle').html('РАЗВЕРНУТЬ');
            $(".menu-left__toggle").addClass('rolldown');
            $('.menu-left ul').toggle('normal');
            $('.menu-left__toggle').click(function () {
                $(this).parent().children('ul').toggle('normal');
                if(this.innerHTML == 'РАЗВЕРНУТЬ') {
                    this.innerHTML = 'СВЕРНУТЬ';
                    $(".menu-left__toggle").addClass('rollup');
                    $(".menu-left__toggle").removeClass('rolldown');
                }
                else
                {
                    this.innerHTML = 'РАЗВЕРНУТЬ';
                    $(".menu-left__toggle").removeClass('rollup');
                    $(".menu-left__toggle").addClass('rolldown');

                }
                return false;
            });
        });
    </script>
@stop