@props(['categories'])
<header class="2xl:container 2xl:mx-auto">

    <div class="bg-white rounded shadow-lg py-5 px-7">
        <nav class="flex justify-between">
            <ul class="hidden md:flex flex-auto space-x-2 items-center">
                <li class="text-white h-fit bg-indigo-600 px-3 py-2.5 rounded"><a
                        class="block w-full" href="/home">Home</a></li>
                <li class="text-white h-fit bg-indigo-600 px-3 py-2.5 rounded"><a
                        class="block w-full" href="/profile">Profile</a>
                </li>
                <li class="text-white h-fit bg-indigo-600 px-3 py-2.5 rounded"><a
                        class="block w-max" href="{{ route('post') }}">Create Post</a>
                </li>
            </ul>
            @if (Request::is('home/*') || Request::is('home') ||  Request::is('search') ||   Request::is('search/*') )
                <x-search_card :categories="$categories"/>
            @endif
        </nav>
        <div class="block md:hidden w-full mt-5 ">
            <div onclick="selectNew()"
                 class="cursor-pointer px-4 py-3 text-white bg-indigo-600 rounded flex justify-between items-center w-full">
                <div class="flex space-x-2">
                    <span id="s1" class="font-semibold text-sm leading-3 hidden">Selected: </span>
                    <p id="textClicked"
                       class="font-normal text-sm leading-3 focus:outline-none hover:bg-gray-800 duration-100 cursor-pointer ">
                        Pages</p>
                </div>
                <svg id="ArrowSVG" class=" transform" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 9L12 15L18 9" stroke="white" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <div class=" relative">
                <ul id="list" class=" hidden font-normal text-base leading-4 absolute top-2  w-full rounded shadow-md">
                    <li onclick="selected()" class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="">Home</a>
                    </li>
                    <li onclick="selected()" class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="/profile">Profile</a>
                    </li>
                    <li class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="">Create
                            Post</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
