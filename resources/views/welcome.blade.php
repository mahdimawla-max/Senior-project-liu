<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- ✅ ADD THIS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
    <script src="/js/main.js"></script>
</head>


<body
    class="
        @if(Request::is('login') || Request::is('register'))
            bg-gradient-to-r from-indigo-800 to-blue-900
        @else
            bg-white
        @endif
    "
>

@if(Request::is('home/*') || Request::is('home') || Request::is('search') || Request::is('search/*'))
    <x-header :categories="$categories"></x-header>
@else
    <x-header></x-header>
@endif

@yield('content')

</body>
<script>
    function toggleComments(postId) {
        const el = document.getElementById('comments-' + postId);
        if (!el) return;

        el.classList.toggle('hidden');
    }
</script>

</script>


</html>
