@extends('welcome')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-800 to-blue-900 min-h-screen flex flex-col justify-between">
<?php
//    dd($shares)
?>
<div
    class="bg-white mx-auto dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/3 text-center mb-8 md:mb-0">
            <img src="{{($user->profilepicture)?$user->profilepicture:'/images/user-placeholder.png'}}"
                 alt="Profile Picture"
                 class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-indigo-800 dark:border-blue-900 transition-transform duration-300 hover:scale-105">
            <h1 class="text-2xl font-bold text-indigo-800 dark:text-white mb-2">{{$user->fullname}}</h1>
            {{--                <p class="text-gray-600 dark:text-gray-300">Software Developer</p>--}}
            <a href="/profileedit">Edit</a>
        </div>
        <div class="md:w-2/3 md:pl-8">
            @if($user->about)
                <h2 class="text-xl font-semibold text-indigo-800 dark:text-white mb-4">About Me</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    {{$user->about}}
                </p>
            @endif
            <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                <li class="flex items-center">
                    username :{{$user->username}}
                </li>
                @if($user->birthdate)
                <li class="flex items-center">
                    birthday : {{$user->birthdate}}
                </li>
                @endif
                @if($user->location)
                <li class="flex items-center">
                    location : {{$user->location}}
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
</style>
@foreach($posts as $post)
    <x-post_card :post="$post">
    </x-post_card>
@endforeach
@foreach($shares as $share)
    <x-share-card :post="$share">
    </x-share-card>
@endforeach
{{--<x-post_card>--}}
{{--</x-post_card>--}}
<script>

    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.classList.add('dark');
    }

    const skillTags = document.querySelectorAll('.bg-indigo-100');
    skillTags.forEach(tag => {
        tag.addEventListener('mouseover', () => {
            tag.classList.remove('bg-indigo-100', 'text-indigo-800');
            tag.classList.add('bg-blue-900', 'text-white');
        });
        tag.addEventListener('mouseout', () => {
            tag.classList.remove('bg-blue-900', 'text-white');
            tag.classList.add('bg-indigo-100', 'text-indigo-800');
        });
    });
</script>
</body>
</html>
@endsection
