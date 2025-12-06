<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
    <script src="/js/main.js"></script>
</head>
<body class="bg-gradient-to-r from-indigo-800 to-blue-900">
@if(Request::is('home/*') || Request::is('home') ||  Request::is('search') ||   Request::is('search/*'))
    <x-header :categories="$categories"></x-header>
@else
    <x-header></x-header>
@endif
@yield('content')
</body>
</html>
