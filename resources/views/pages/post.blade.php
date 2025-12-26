@extends('welcome')
@section('content')

<div class="min-h-screen flex items-start justify-center pt-16 px-4">

    <div class="w-full max-w-2xl">
        {{-- Page Title --}}
        <h1 class="text-center text-3xl font-bold text-white mb-8">
            Create New Post
        </h1>

        <form action="/posts/store" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Editor Card --}}
            <div
                class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg
                       border border-gray-200 dark:border-gray-700
                       rounded-2xl shadow-xl p-6 flex flex-col space-y-6">

                {{-- Title --}}
                <input
                    name="title"
                    type="text"
                    required
                    placeholder="Post title"
                    class="w-full rounded-lg bg-gray-100 dark:bg-gray-700
                           border border-gray-300 dark:border-gray-600
                           px-4 py-3 text-gray-800 dark:text-gray-100
                           placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >

                {{-- Description --}}
                <textarea
                    name="description"
                    id="descriptionField"
                    required
                    spellcheck="false"
                    placeholder="Describe everything about this post..."
                    class="w-full h-56 rounded-lg bg-gray-100 dark:bg-gray-700
                           border border-gray-300 dark:border-gray-600
                           px-4 py-3 text-gray-800 dark:text-gray-100
                           placeholder-gray-400 resize-none
                           focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >{{ old('description') }}</textarea>

                {{-- Image Preview --}}
                <div id="photoPreview" class="rounded-xl overflow-hidden">
                    @if(isset($photoPath))
                        <img
                            src="{{ asset('uploaded/' . $photoPath) }}"
                            alt="Uploaded Photo"
                            class="w-full h-48 object-cover"
                        >
                    @endif
                </div>

                {{-- Upload Photo Card --}}
                <label
                    class="group relative flex flex-col items-center justify-center
                           h-40 rounded-xl border-2 border-dashed
                           border-gray-300 dark:border-gray-600
                           cursor-pointer transition
                           hover:border-indigo-500 hover:bg-indigo-50/50
                           dark:hover:bg-gray-700/50">

                    <input
                        type="file"
                        name="photo"
                        id="photoInput"
                        accept="image/*"
                        required
                        class="hidden"
                    >

                    <div class="text-center">
                        <div
                            class="mx-auto mb-3 w-12 h-12 rounded-full
                                   bg-indigo-100 dark:bg-indigo-900/40
                                   flex items-center justify-center
                                   group-hover:scale-110 transition">
                            📷
                        </div>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            Upload a photo
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            PNG, JPG up to 5MB
                        </p>
                    </div>
                </label>

                {{-- Actions --}}
                <div class="flex justify-end gap-4 pt-2">

                    {{-- Cancel --}}
                    <a
                        href="/home"
                        class="px-6 py-2 rounded-lg border
                               border-gray-300 dark:border-gray-600
                               text-gray-600 dark:text-gray-300
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               transition font-medium">
                        Cancel
                    </a>

                    {{-- Publish --}}
                    <button
                        type="submit"
                        class="px-7 py-2 rounded-lg font-semibold text-white
                               bg-gradient-to-r from-indigo-500 to-purple-600
                               hover:from-indigo-600 hover:to-purple-700
                               transition-all duration-300
                               shadow-lg hover:shadow-indigo-500/40">
                        Publish
                    </button>

                </div>

            </div>
        </form>
    </div>

</div>

@endsection
