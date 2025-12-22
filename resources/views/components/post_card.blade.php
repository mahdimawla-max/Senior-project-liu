@props(['post','user'])

<?php
$timeAgo = \Illuminate\Support\Carbon::parse($post->created_at)->diffForHumans();
$initialLiked = \App\Models\Reaction::query()
    ->where('userid', auth()->id())
    ->where('postid', $post->post_id)
    ->exists();
$numberOfLikes = \App\Models\Reaction::query()
    ->where('postid', $post->post_id)
    ->count();
?>

<article class="mx-auto max-w-[900px] my-6 rounded-2xl bg-white dark:bg-slate-800
                border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center gap-4">
            <img class="w-12 h-12 rounded-full object-cover"
                 src="{{ $post->profilepicture ?: '/images/user-placeholder.png' }}">
            <div>
                <p class="font-semibold text-slate-800 dark:text-white">
                    {{ $post->fullname }}
                </p>
                <span class="text-sm text-slate-500">
                    {{ $timeAgo }}
                </span>
            </div>
        </div>

        @if(Request::is('profile'))
            <form action="/delete-post/{{ $post->post_id }}" method="POST">
                @csrf
                <button class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                    <img src="/images/trash.svg" class="w-5">
                </button>
            </form>
        @endif
    </div>

    {{-- Content --}}
    @if($post->description)
        <p class="px-6 pb-4 text-slate-700 dark:text-slate-200">
            {{ $post->description }}
        </p>
    @endif

    @if($post->content)
        <div class="px-6 pb-4">
            <img src="{{ $post->content }}"
                 class="w-full rounded-xl max-h-[500px] object-cover">
        </div>
    @endif

    {{-- Actions --}}
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">

        <div class="flex items-center justify-between">

            {{-- Like --}}
            <form id="form-{{ $post->post_id }}"
                  class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                @csrf
                <svg
                    onclick="toggleToLike('heart-icon-{{ $post->post_id }}','number-of-likes-{{ $post->post_id }}',{{ $post->post_id }})"
                    id="heart-icon-{{ $post->post_id }}"
                    class="w-6 h-6 cursor-pointer transition hover:scale-110 heart-icon {{ $initialLiked ? 'isLiked' : '' }}"
                    viewBox="0 0 106 97">
                    <path class="fill-color-shape" d="M73.04 3.05C65.7 2.94 58.35 5.38 53.25 12.38C48.13 5.39 40.63 3.05 33.47 3.05C18.26 3.05 3.05 15.7 3.05 33.47C3.05 51.1 14.37 66.12 26.17 76.68C38.15 88.25 53.25 93.56 53.25 93.56C53.25 93.56 68.35 88.25 80.33 76.68C92.13 66.12 103.45 51.1 103.45 33.47C103.45 15.7 88.23 3.27 73.04 3.05Z"/>
                </svg>
                <span id="number-of-likes-{{ $post->post_id }}">
                    {{ $numberOfLikes }}
                </span>
            </form>

            {{-- Actions --}}
            <div class="flex items-center gap-2">

                {{-- Comments --}}
                <button
                    onclick="toggleComments({{ $post->post_id }})"
                    class="px-3 py-2 text-sm rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                    Comments
                </button>

                {{-- Share --}}
                <form action="/create-share/{{ auth()->id() }}" method="post">
                    @csrf
                    <input type="hidden" name="description" value="..">
                    <input type="hidden" name="postid" value="{{ $post->post_id }}">
                    <button
                        class="px-3 py-2 text-sm rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        Share
                    </button>
                </form>

            </div>
        </div>

        {{-- COMMENTS LIST --}}
        <div
            id="comments-{{ $post->post_id }}"
            class="mt-4 space-y-3
                   max-h-0 overflow-hidden
                   opacity-0
                   transition-all duration-300 ease-in-out">

            @foreach($post->comments as $item)
                <div class="p-4 rounded-xl bg-slate-100 dark:bg-slate-700">
                    <div class="flex items-center gap-3 mb-1">
                        <img class="w-8 h-8 rounded-full"
                             src="{{ $item->user->profilepicture ?? '/images/user-placeholder.png' }}">
                        <div>
                            <p class="text-sm font-semibold text-slate-800 dark:text-white">
                                {{ $item->user->fullname ?? 'Unknown user' }}
                            </p>
                            <span class="text-xs text-slate-500">
                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-700 dark:text-slate-200">
                        {{ $item->comment }}
                    </p>
                </div>
            @endforeach

            {{-- Add Comment --}}
            <form class="relative mt-3"
                  id="comment-for-post-{{ $post->post_id }}"
                  onsubmit="submitComment('comment-for-post-{{ $post->post_id }}', event)">
                @csrf
                <input type="hidden" name="userid" value="{{ auth()->id() }}">
                <input type="hidden" name="postid" value="{{ $post->post_id }}">

                <input
                    name="comment"
                    class="w-full h-10 px-4 pr-12 rounded-xl bg-white dark:bg-slate-800
                           border border-slate-300 dark:border-slate-600
                           text-sm placeholder:text-slate-500"
                    placeholder="Write a comment...">

                <button class="absolute right-3 top-1/2 -translate-y-1/2">
                    <svg class="w-4 h-4 fill-slate-500" viewBox="0 0 24 24">
                        <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</article>
