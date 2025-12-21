@props(['categories'])

<!-- Main header -->
<header class="w-full bg-gray-900 border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-4">

            <!-- Navigation bar -->
            <nav class="flex items-center justify-between gap-4">

                <!-- LEFT: App title + desktop navigation -->
                <div class="flex items-center gap-6">

                    <!-- App title / logo (UI only) -->
                    <a href="/home"
                       class="flex items-center gap-3 text-white font-semibold
                              transition-colors duration-200 ease-in-out hover:text-gray-100">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl
                                     bg-gray-800 text-white shadow-sm
                                     transition-colors duration-200 ease-in-out hover:bg-gray-700">
                            <!-- board/grid icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4 6h6v6H4V6zm10 0h6v6h-6V6zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z"/>
                            </svg>
                        </span>

                        <span class="hidden sm:inline text-lg">
                            Community Board
                        </span>
                    </a>

                    <!-- Desktop navigation links -->
                    <ul class="hidden md:flex items-center gap-5 text-sm">

                        <!-- Home -->
                        <li>
                            <a href="/home"
                               class="pb-1 transition-colors duration-200 ease-in-out
                               {{ Request::is('home') || Request::is('home/*')
                                    ? 'font-semibold text-white border-b-2 border-white'
                                    : 'text-gray-300 hover:text-gray-100 hover:border-b-2 hover:border-gray-300' }}">
                                Home
                            </a>
                        </li>

                        <!-- Profile -->
                        <li>
                            <a href="/profile"
                               class="pb-1 transition-colors duration-200 ease-in-out
                               {{ Request::is('profile') || Request::is('profile/*')
                                    ? 'font-semibold text-white border-b-2 border-white'
                                    : 'text-gray-300 hover:text-gray-100 hover:border-b-2 hover:border-gray-300' }}">
                                Profile
                            </a>
                        </li>

                        <!-- Create Post -->
                        <li>
                            <a href="{{ route('post') }}"
                               class="pb-1 transition-colors duration-200 ease-in-out
                               {{ Request::is('post') || Request::is('post/*')
                                    ? 'font-semibold text-white border-b-2 border-white'
                                    : 'text-gray-300 hover:text-gray-100 hover:border-b-2 hover:border-gray-300' }}">
                                Create Post
                            </a>
                        </li>

                        <!-- Logout -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="pb-1 text-gray-300 hover:text-gray-100 transition-colors duration-200 ease-in-out">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- CENTER: Search (only on home/search pages) -->
                <div class="flex-1 flex justify-center">
                    @if (Request::is('home/*') || Request::is('home') || Request::is('search') || Request::is('search/*'))
                        <x-search_card :categories="$categories"/>
                    @endif
                </div>

                <!-- RIGHT: Avatar placeholder (UI only) -->
                <div class="hidden md:flex items-center gap-3">
                    <div class="text-right leading-tight">
                        <p class="text-sm font-semibold text-white">Welcome</p>
                        <p class="text-xs text-gray-400">User</p>
                    </div>

                    <div class="h-10 w-10 rounded-full bg-gray-800 border border-gray-700
                                flex items-center justify-center text-gray-200 font-semibold
                                transition-colors duration-200 ease-in-out hover:bg-gray-700">
                        U
                    </div>
                </div>
            </nav>

            <!-- MOBILE NAV -->
            <div class="block md:hidden w-full mt-4">

                <!-- Dropdown trigger -->
                <div onclick="selectNew()"
                     class="cursor-pointer px-4 py-3 text-gray-200 bg-gray-800
                            border border-gray-700 rounded-xl
                            flex justify-between items-center w-full
                            transition-colors duration-200 ease-in-out
                            hover:bg-gray-700">
                    <p id="textClicked" class="font-medium text-sm">
                        Pages
                    </p>

                    <svg id="ArrowSVG" class="h-5 w-5 text-gray-300 transition-transform duration-200 ease-in-out"
                         xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 9l6 6 6-6"/>
                    </svg>
                </div>

                <!-- Dropdown list -->
                <div class="relative">
                    <ul id="list"
                        class="hidden absolute top-2 w-full rounded-xl shadow-lg
                               border border-gray-700 bg-gray-800 overflow-hidden">

                        <li onclick="selected()"
                            class="px-4 py-3 transition-colors duration-200 ease-in-out hover:bg-gray-700">
                            <a class="block text-sm font-medium text-gray-200" href="/home">
                                Home
                            </a>
                        </li>

                        <li onclick="selected()"
                            class="px-4 py-3 transition-colors duration-200 ease-in-out hover:bg-gray-700">
                            <a class="block text-sm font-medium text-gray-200" href="/profile">
                                Profile
                            </a>
                        </li>

                        <li onclick="selected()"
                            class="px-4 py-3 transition-colors duration-200 ease-in-out hover:bg-gray-700">
                            <a class="block text-sm font-medium text-gray-200" href="{{ route('post') }}">
                                Create Post
                            </a>
                        </li>

                        <li class="px-4 py-3 transition-colors duration-200 ease-in-out hover:bg-gray-700">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block text-sm font-medium text-gray-200 w-full text-left">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </div>
</header>
