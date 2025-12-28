<div class="relative w-full flex items-center justify-between gap-3 p-4 max-md:flex-col">

    {{-- Categories Dropdown --}}
    <div
        id="dropdown-open"
        onclick="toggleElementById('categories-dropdown')"
        class="relative max-md:w-full inline-flex items-center justify-between gap-2 px-4 py-2.5 text-sm font-medium
               text-slate-700 dark:text-white
               bg-slate-100 dark:bg-slate-700
               border border-slate-200 dark:border-slate-600
               rounded-xl cursor-pointer
               hover:bg-slate-200 dark:hover:bg-slate-600
               transition">

        <span>Categories</span>

        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2"
                  d="m1 1 4 4 4-4"/>
        </svg>

        {{-- Dropdown --}}
        <div
            id="categories-dropdown"
            class="absolute top-[46px] left-0 w-full
                   opacity-0 pointer-events-none
                   bg-white dark:bg-slate-800
                   border border-slate-200 dark:border-slate-700
                   rounded-xl shadow-md
                   overflow-hidden
                   transition">

            @foreach ($categories as $category)
                <a href="/home/{{ $category->id }}"
                   class="block px-4 py-2 text-sm
                          text-slate-700 dark:text-slate-200
                          hover:bg-slate-100 dark:hover:bg-slate-700
                          transition">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Search --}}
    <div class="relative w-full max-w-md">
        <form method="GET" action="{{ route('search') }}" class="flex w-full">
            <input
                type="search"
                name="query"
                value="{{ request('query') }}"
                class="w-full h-11 px-4 text-sm
                       text-slate-700 dark:text-white
                       bg-slate-100 dark:bg-slate-700
                       border border-slate-200 dark:border-slate-600
                       rounded-l-xl
                       placeholder:text-slate-500
                       focus:outline-none focus:ring-2 focus:ring-slate-300
                       transition"
                placeholder="Search posts..."
                required
            />

            <button
                type="submit"
                class="h-11 px-4
                       bg-slate-700 dark:bg-slate-600
                       text-white
                       rounded-r-xl
                       hover:bg-slate-800 dark:hover:bg-slate-500
                       transition flex items-center justify-center">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </button>
        </form>
    </div>
</div>
