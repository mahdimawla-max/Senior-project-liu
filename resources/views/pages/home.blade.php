@extends('welcome')
@section('content')
@foreach($posts as $post)
    <x-post_card  :post="$post" >
    </x-post_card>
@endforeach

@endsection




