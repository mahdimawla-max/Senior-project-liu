@extends('welcome')

@section('content')

<div class="min-h-screen bg-gray-100 py-10">

    <!-- ================= PROFILE CARD ================= -->
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-10">

        <div class="flex flex-col md:flex-row gap-10">

            <!-- ===== LEFT: AVATAR ===== -->
            <div class="md:w-1/3 text-center">
                <img
                    src="{{ ($user->profilepicture) ? $user->profilepicture : '/images/user-placeholder.png' }}"
                    alt="Profile Picture"
                    onclick="openImageModal(this.src)"
                    class="w-40 h-40 rounded-full mx-auto object-cover cursor-pointer
                           ring-4 ring-indigo-500/30 shadow-md
                           transition-transform duration-300 hover:scale-105"
                >

                <h1 class="mt-4 text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $user->fullname }}
                </h1>

                <!-- Stats -->
                <div class="flex justify-center gap-6 mt-3 text-sm text-gray-600 dark:text-gray-300">
                    <div>
                        <span class="block font-semibold text-gray-800 dark:text-white">
                            {{ $posts->count() }}
                        </span>
                        Posts
                    </div>
                    <div>
                        <span class="block font-semibold text-gray-800 dark:text-white">
                            {{ $shares->count() }}
                        </span>
                        Shares
                    </div>
                </div>

                <a
                    href="/profileedit"
                    class="inline-block mt-5 px-6 py-2 rounded-lg
                           bg-indigo-600 text-white text-sm font-medium
                           hover:bg-indigo-700 hover:shadow-md transition"
                >
                    Edit Profile
                </a>
            </div>

            <!-- ===== RIGHT: INFO (REORDERED & FILLED) ===== -->
            <div class="md:w-2/3">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <!-- Username -->
                    <div>
                        <p class="text-sm text-gray-500">Username</p>
                        <p class="font-medium text-gray-800 dark:text-white">
                            {{ $user->username }}
                        </p>
                    </div>

                    <!-- Location -->
                    @if($user->location)
                        <div>
                            <p class="text-sm text-gray-500">Location</p>
                            <p class="font-medium text-gray-800 dark:text-white">
                                {{ $user->location }}
                            </p>
                        </div>
                    @endif

                    <!-- Birthday -->
                    @if($user->birthdate)
                        <div>
                            <p class="text-sm text-gray-500">Birthday</p>
                            <p class="font-medium text-gray-800 dark:text-white">
                                {{ $user->birthdate }}
                            </p>
                        </div>
                    @endif

                </div>

                <!-- About (FULL WIDTH) -->
                @if($user->about)
                    <div class="mt-6 border-t pt-6">
                        <p class="text-sm text-gray-500 mb-1">About</p>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $user->about }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- ================= POSTS ================= -->
    <div class="max-w-5xl mx-auto space-y-6">
        @foreach($posts as $post)
            <x-post_card :post="$post"></x-post_card>
        @endforeach

        @foreach($shares as $share)
            <x-share-card :post="$share"></x-share-card>
        @endforeach
    </div>

</div>

<!-- ================= IMAGE MODAL ================= -->
<div
    id="imageModal"
    class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50"
    onclick="closeImageModal()"
>
    <img id="modalImage" class="max-w-[90%] max-h-[90%] rounded-xl shadow-2xl">
</div>

<script>
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('flex');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.getElementById('imageModal').classList.remove('flex');
    }
</script>

@endsection
