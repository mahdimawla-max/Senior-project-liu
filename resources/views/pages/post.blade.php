@extends('welcome')
@section('content')

<div class="heading text-center font-bold text-2xl m-5 text-white">New Post</div>
<form action="/posts/store" method="post" enctype="multipart/form-data" class="">
    @csrf
  <div class="dark:bg-gray-800 editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
    <input name="title" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" required placeholder="Title" type="text">
    <textarea name="description" id="descriptionField"
                  class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none"
                  spellcheck="false" placeholder="Describe everything about this post here" required>{{ old('description') }}</textarea>
                  <div id="photoPreview" class="mt-2">
                    @if(isset($photoPath))
                        <img src="{{ asset('uploaded/' . $photoPath) }}" alt="Uploaded Photo" class="w-full h-48 object-cover">
                    @endif
                </div>


    <div class="icons flex text-gray-500 m-2">
    <input type="file" name="photo" id="photoInput" class="" accept="image/*" required>
    </div>

    <div class="buttons flex">
      <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto opacity-0">Cancel</div>
      <button type="submit" class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">Post</button>
    </div>
  </div>
</form>



@endsection
