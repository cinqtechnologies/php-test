<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">

    <title> @yield('title') </title>
</head>
<body>
<!--Child container-->
@hasSection('content')
    @yield('content')
@endif

<script src="{{asset("js/app.js")}}"></script>
<script src="{{asset("js/base.js")}}"></script>
</body>
</html>
