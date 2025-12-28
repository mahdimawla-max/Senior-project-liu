@props(['post','user'])

<?php
$timeAgo = \Illuminate\Support\Carbon::parse($post->created_at)->diffForHumans();
$initialLiked = \App\Models\Reaction::where('userid', auth()->id())
    ->where('postid', $post->post_id)
    ->exists();
$numberOfLikes = \App\Models\Reaction::where('postid', $post->post_id)->count();

/* 🔴 SHARED POST HELPERS (SAFE FIX) */
$isShared = !is_null($post->shared_post_id ?? null);
$originalPost = null;

if ($isShared) {
    $originalPost = $post->sharedPost;

    if (!$originalPost) {
        $originalPost = \App\Models\Post::with('user')
            ->find($post->shared_post_id);
    }
}
?>

<article class="mx-auto max-w-[900px] my-6 rounded-2xl bg-white dark:bg-slate-800
                border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">

{{-- Header --}}
<div class="flex items-center justify-between px-6 py-4">
    <div class="flex items-center gap-4">
        {{-- Profile link --}}
        <a href="/profile/{{ $post->user_id }}"
           class="flex items-center gap-4 hover:opacity-90 transition">

            <img class="w-12 h-12 rounded-full object-cover cursor-pointer"
                 src="{{ $post->profilepicture ? asset($post->profilepicture) : asset('/images/user-placeholder.png') }}">

            <div>
                <p class="font-semibold text-slate-800 dark:text-white hover:underline">
                    {{ $post->fullname }}
                </p>

                <span class="text-sm text-slate-500">
                    {{ $timeAgo }}
                </span>

                {{-- ✅ CATEGORY BADGE --}}
               <span class="inline-flex items-center mt-1 px-3 py-1 text-xs font-medium
             rounded-full
             bg-indigo-50 text-indigo-600
             border border-indigo-100
             dark:bg-indigo-900/40 dark:text-indigo-300 dark:border-indigo-800">
    {{ $isShared && $originalPost
        ? ($originalPost->category->name ?? 'General')
        : ($post->category->name ?? 'General')
    }}
</span>

            </div>
        </a>
    </div>


    {{-- DELETE BUTTON (OWNER ONLY) --}}
    @if(auth()->id() === $post->userid)
        <form action="/delete-post/{{ $post->post_id }}" method="POST"
              onsubmit="return confirm('Delete this post?')">
            @csrf
           <button
    class="group p-2 rounded-full 
           text-slate-400 
           hover:text-red-600 
           hover:bg-red-50 
           transition-all duration-200
           focus:outline-none focus:ring-2 focus:ring-red-300"
    title="Delete post">

    {{-- Trash Icon --}}
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         stroke-width="2">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                 a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                 M9 7h6m2 0H7m3-3h4
                 a1 1 0 011 1v1H9V5a1 1 0 011-1z" />
    </svg>
</button>

        </form>
    @endif
</div>

{{-- 🔴 SHARED INFO --}}
@if($isShared && $originalPost)
    <div class="flex items-center gap-2 px-6 pb-2 text-sm text-slate-500">
        <img class="w-8 h-8 rounded-full object-cover"
     src="{{ $originalPost->user->profilepicture
            ? asset($originalPost->user->profilepicture)
            : asset('images/user-placeholder.png') }}">

        <span>
            <strong>{{ $post->fullname }}</strong> shared
            <strong>{{ $originalPost->user->fullname }}</strong>'s post
        </span>
    </div>
@endif


{{-- Content --}}
@if($isShared && $originalPost)

    @if($originalPost->description)
        <p class="px-6 pb-4 text-slate-700 dark:text-slate-200">
            {{ $originalPost->description }}
        </p>
    @endif

    @if($originalPost->content)
        <div class="px-6 pb-4">
            <img src="{{ asset($originalPost->content) }}"
                 onclick="openImage(this.src)"
                 class="w-full rounded-xl max-h-[500px] object-cover cursor-pointer">
        </div>
    @endif

@else

    @if($post->description)
        <p class="px-6 pb-4 text-slate-700 dark:text-slate-200">
            {{ $post->description }}
        </p>
    @endif

    @if($post->content)
        <div class="px-6 pb-4">
            <img src="{{ asset($post->content) }}"
                 onclick="openImage(this.src)"
                 class="w-full rounded-xl max-h-[500px] object-cover cursor-pointer">
        </div>
    @endif

@endif

{{-- ACTION BAR (FIXED) --}}
<div class="px-6 py-3 border-t border-slate-200 dark:border-slate-700
            sticky bottom-0 bg-white dark:bg-slate-800 z-10">
<div class="flex items-center justify-between">

    {{-- ❤️ LIKE --}}
    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
        <svg
            data-post-id="{{ $post->post_id }}"
            onclick="toggleToLike(this)"
            class="w-6 h-6 cursor-pointer transition hover:scale-110 heart-icon {{ $initialLiked ? 'isLiked' : '' }}"
            viewBox="0 0 106 97">
            <path class="fill-color-shape"
                  d="M73.04 3.05C65.7 2.94 58.35 5.38 53.25 12.38C48.13 5.39 40.63 3.05 33.47 3.05C18.26 3.05 3.05 15.7 3.05 33.47C3.05 51.1 14.37 66.12 26.17 76.68C38.15 88.25 53.25 93.56 53.25 93.56C53.25 93.56 68.35 88.25 80.33 76.68C92.13 66.12 103.45 51.1 103.45 33.47C103.45 15.7 88.23 3.27 73.04 3.05Z"/>
        </svg>
        <span class="text-sm">{{ $numberOfLikes }}</span>
    </div>

    {{-- 💬 COMMENT (ICON + COUNT UNDER) --}}
    <div class="flex flex-col items-center text-slate-600 dark:text-slate-300">
        <button
            onclick="toggleComments({{ $post->post_id }})"
            class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20"
                 fill="currentColor"
                 class="w-5 h-5">
                <path fill-rule="evenodd"
                      d="M10 3c-4.31 0-8 3.033-8 7 0 2.024.978 3.825 2.499 5.085a3.478 3.478 0 0 1-.522 1.756.75.75 0 0 0 .584 1.143 5.976 5.976 0 0 0 3.936-1.108c.487.082.99.124 1.503.124 4.31 0 8-3.033 8-7s-3.69-7-8-7Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm-2-1a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                      clip-rule="evenodd"/>
            </svg>
        </button>

        <span class="text-xs text-slate-500 mt-1">
            {{ $post->comments_count ?? ($post->comments->count() ?? 0) }}
        </span>
    </div>

    {{-- 🔗 SHARE (ICON + COUNT UNDER) --}}
    <div class="flex flex-col items-center text-slate-600 dark:text-slate-300">
        <form action="/create-share/{{ auth()->id() }}" method="POST">
            @csrf
            <input type="hidden" name="description" value="..">
            <input type="hidden" name="postid" value="{{ $post->post_id }}">
            <button type="submit"
                    class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20"
                     fill="currentColor"
                     class="w-5 h-5">
                    <path d="M13 4.5a2.5 2.5 0 1 1 .702 1.737L6.97 9.604a2.518 2.518 0 0 1 0 .792l6.733 3.367a2.5 2.5 0 1 1-.671 1.341l-6.733-3.367a2.5 2.5 0 1 1 0-3.475l6.733-3.366A2.52 2.52 0 0 1 13 4.5Z"/>
                </svg>
            </button>
        </form>

        <span class="text-xs text-slate-500 mt-1">
            {{ $isShared && $originalPost
                ? $originalPost->sharesCount()
                : $post->sharesCount()
            }}
        </span>
    </div>

</div>



{{-- COMMENTS PANEL --}}
<div id="comments-{{ $post->post_id }}"
     class="hidden border-t border-slate-200 dark:border-slate-700">

    <div class="max-h-[260px] overflow-y-auto px-6 py-4 space-y-3">
        @foreach($post->comments as $item)
            <div class="p-3 rounded-xl bg-slate-100 dark:bg-slate-700">
                <div class="flex items-center gap-3 mb-1">
                    <img class="w-8 h-8 rounded-full"
                         src="{{ $item->user->profilepicture ?? '/images/user-placeholder.png' }}">
                    <div>
                        <p class="text-sm font-semibold">
                            {{ $item->user->fullname ?? 'Unknown user' }}
                        </p>
                        <span class="text-xs text-slate-500">
                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                        </span>
                    </div>
                </div>
                <p class="text-sm">{{ $item->comment }}</p>
            </div>
        @endforeach
    </div>

    <form class="relative px-6 py-3 border-t border-slate-200 dark:border-slate-700
                 bg-white dark:bg-slate-800"
          onsubmit="submitComment(this, event)">
        @csrf
        <input type="hidden" name="userid" value="{{ auth()->id() }}">
        <input type="hidden" name="postid" value="{{ $post->post_id }}">

        <input
            name="comment"
            class="w-full h-11 px-4 pr-12 rounded-xl border text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-500"
            placeholder="Write a comment...">

        <button type="submit"
                class="absolute right-9 top-1/2 -translate-y-1/2">
            <svg class="w-4 h-4 fill-slate-500" viewBox="0 0 24 24">
                <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"/>
            </svg>
        </button>
    </form>
</div>
</article>

{{-- IMAGE OVERLAY --}}
<div id="imageOverlay"
     onclick="closeImage()"
     class="fixed inset-0 hidden items-center justify-center
            bg-black/60 backdrop-blur-md z-50">
    <img id="overlayImage"
         class="max-w-[90%] max-h-[90%] rounded-xl shadow-2xl">
</div>

<script>
function openImage(src) {
    const overlay = document.getElementById('imageOverlay');
    const img = document.getElementById('overlayImage');

    img.src = src;
    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
}

function closeImage() {
    const overlay = document.getElementById('imageOverlay');

    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
}
</script>

<script>
async function submitComment(form, event) {
    event.preventDefault();

    const formData = new FormData(form);
    const postId = formData.get('postid');
    const input = form.querySelector('input[name="comment"]');

    if (!input.value.trim()) return;

    const res = await fetch('/create-comment', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    });

    if (!res.ok) return;

    const data = await res.json();

    const list = document.querySelector(
        `#comments-${postId} .overflow-y-auto`
    );

    list.insertAdjacentHTML('afterbegin', `
        <div class="p-3 rounded-xl bg-slate-100 dark:bg-slate-700">
            <p class="text-sm font-semibold">${data.user.fullname}</p>
            <p class="text-sm">${data.comment}</p>
        </div>
    `);

    input.value = '';
}
</script>
