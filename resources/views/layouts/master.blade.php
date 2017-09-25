<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wam - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Wam</a>
        </div>
        <div id="navbar" class="collpse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Главная</a></li>
                <li><a href="/admin/category/list/1">Каталог</a></li>
                <li><a href="{{route('list-news')}}">Новости</a></li>
                <li><a href="#delivery">Доставка и оплата</a></li>
                <li><a href="/exit">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div id="app" class="content">
        @yield('content')
    </div>
</div>
<!--<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>-->
<script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]);
    ?>;
</script>
<script src="/js/app.js" type="application/javascript"></script>
@yield('view.scripts')
</body>
</html>
