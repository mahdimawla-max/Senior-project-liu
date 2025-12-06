@extends('welcome')
@section('content')
    <div class="max-w-4xl max-sm:max-w-lg mx-auto font-[sans-serif] p-6">
        <div class="text-center mb-12 sm:mb-16">
            <h4 class="text-gray-600 text-base mt-6">Edit Your Profile</h4>
        </div>
        <form action="/update-user/{{$user->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Full Name</label>
                    <input name="fullname" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter name" />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Birth Day</label>
                    <input type="date" name="birthdate" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all">
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Profile Picture</label>
                    <input name="profilepicture" type="file" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"  />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Location</label>
                    <input name="location" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter name" />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">About</label>
                    <input name="about" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter name" />
                </div>
            </div>
            <div class="mt-8">
                <button  class="mx-auto block py-3 px-6 text-sm tracking-wider rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    Edit
                </button>
            </div>
        </form>
    </div>
@endsection
