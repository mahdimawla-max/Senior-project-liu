@props(['post' ,'user'])
<?php
$timeAgo = \Illuminate\Support\Carbon::parse($post->created_at)->diffForHumans();
$initialLiked = \App\Models\Reaction::query()->where('userid', auth()->id())->where('postid', $post->post_id)->exists();
$numberOfLikes = \App\Models\Reaction::query()->where('postid', $post->post_id)->count();
?>

<article
    class="mx-auto max-w-[900px] my-5 rounded-2xl
           bg-slate-50 dark:bg-slate-900
           border border-slate-200 dark:border-slate-700
           shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4">
        <div class="flex items-center gap-3">
            <img
                class="w-11 h-11 rounded-full object-cover"
                src="{{ $post->profilepicture ?: '/images/user-placeholder.png' }}"
                alt="User Avatar"
            />
            <div>
                <p class="font-semibold text-slate-800 dark:text-white">
                    {{ $post->fullname }}
                </p>
                <span class="text-xs text-slate-500 dark:text-slate-400">
                    {{ $timeAgo }}
                </span>
            </div>
        </div>

        @if (Request::is('profile'))
            <form action="/delete-post/{{ $post->post_id }}" method="post">
                @csrf
                <button class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                    <img src="/images/trash.svg" class="w-4" alt="Delete">
                </button>
            </form>
        @endif
    </div>

    {{-- Shared Content --}}
    <div class="px-5 pb-4">
        @if($post->description)
            <p class="text-slate-700 dark:text-slate-200 leading-relaxed mb-3">
                {{ $post->description }}
            </p>
        @endif

        @if($post->content)
            <img
                src="{{ $post->content }}"
                alt="Shared content"
                class="w-full max-h-[420px] object-cover rounded-xl border border-slate-200 dark:border-slate-700"
            />
        @endif
    </div>

    {{-- Divider --}}
    <div class="mx-5 h-px bg-slate-200 dark:bg-slate-700"></div>

    {{-- Actions --}}
    <div class="px-5 py-4">
        <div class="flex items-center justify-between">

            {{-- Like --}}
            <form class="flex items-center gap-2 text-slate-600 dark:text-slate-300"
                  id="form-{{ $post->post_id }}">
                @csrf
                <svg
                    onclick="toggleToLike('heart-icon-{{ $post->post_id }}','number-of-likes-{{ $post->post_id }}',{{ $post->post_id }})"
                    class="w-6 h-6 cursor-pointer transition hover:scale-110 heart-icon {{ $initialLiked ? 'isLiked' : '' }}"
                    id="heart-icon-{{ $post->post_id }}"
                    viewBox="0 0 106 97"
                    xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-color-shape" fill-rule="evenodd" clip-rule="evenodd"
                          d="M73.0406 3.04949C65.7359 2.94379 58.3559 5.38824 53.2483 12.3801C48.1271 5.39042 40.631 3.04941 33.4677 3.04941C18.2587 3.04941 3.04622 15.7081 3.04622 33.4698C3.04622 51.0995 14.3683 66.123 26.1679 76.6801C32.0812 81.9708 38.1493 86.1719 43.0557 89.0533C45.5086 90.4938 47.6791 91.6092 49.402 92.3672C50.2628 92.7459 51.0206 93.0393 51.6517 93.2395C52.2639 93.4336 52.8188 93.5607 53.2487 93.5607C53.6786 93.5607 54.2336 93.4336 54.8458 93.2395C55.4769 93.0393 56.2347 92.7459 57.0955 92.3672C58.8183 91.6092 60.9889 90.4938 63.4418 89.0533C68.3481 86.1719 74.4162 81.9708 80.3295 76.6801C92.1292 66.1229 103.451 51.0995 103.451 33.4698C103.451 15.6993 88.2313 3.26928 73.0406 3.04949Z"/>
                </svg>
                <span id="number-of-likes-{{ $post->post_id }}" class="text-sm font-medium">
                    {{ $numberOfLikes }}
                </span>
            </form>

            {{-- Buttons --}}
            <div class="flex gap-2">
                <a href="/comment/{{ $post->post_id }}"
                   class="px-3 py-2 text-sm rounded-lg
                          text-slate-600 dark:text-slate-300
                          hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                    Comments
                </a>

                <form action="/create-share/{{ auth()->id() }}" method="post">
                    @csrf
                    <input type="hidden" name="description" value="..">
                    <input type="hidden" name="postid" value="{{ $post->post_id }}">
                    <button
                        class="px-3 py-2 text-sm rounded-lg
                               text-slate-600 dark:text-slate-300
                               hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                        Share
                    </button>
                </form>
            </div>
        </div>

        {{-- Comment --}}
        <form class="relative mt-4"
              id="comment-for-post-{{ $post->post_id }}"
              onsubmit="submitComment('comment-for-post-{{ $post->post_id }}', event)">
            @csrf
            <input type="hidden" name="userid" value="{{ auth()->id() }}">
            <input type="hidden" name="postid" value="{{ $post->post_id }}">

            <input
                name="comment"
                class="w-full h-10 pl-4 pr-12 rounded-xl
                       bg-slate-100 dark:bg-slate-700
                       text-sm text-slate-700 dark:text-white
                       placeholder:text-slate-500
                       focus:outline-none focus:ring-2 focus:ring-slate-300 transition"
                type="text"
                placeholder="Write a comment..."
            />

            <button class="absolute right-3 top-1/2 -translate-y-1/2">
                <svg class="w-4 h-4 fill-slate-500 hover:fill-slate-700 transition" viewBox="0 0 24 24">
                    <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
                </svg>
            </button>
        </form>
    </div>
</article>
