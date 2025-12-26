<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>

<!-- ❗ Disable page scrolling -->
<body class="h-screen overflow-hidden bg-gradient-to-br from-indigo-900 via-blue-900 to-slate-900">

<!-- Center container WITHOUT forcing height growth -->
<div class="h-full flex items-center justify-center px-6">

    <!-- CARD: fixed height + overflow hidden -->
   <div class="w-full max-w-md h-[92vh]
            bg-white/10 backdrop-blur-lg border border-white/20
            rounded-2xl shadow-xl
            flex flex-col overflow-hidden p-6 sm:p-8">

        <!-- FIXED HEADER -->
        <div class="text-center shrink-0">
            <h2 class="text-3xl font-bold text-white">
                Create an account
            </h2>
            <p class="mt-2 text-sm text-gray-300">
                Fill in your details to get started
            </p>
        </div>

        <!-- FIXED ERRORS -->
        @if ($errors->any())
            <div class="mt-4 shrink-0 rounded-lg bg-red-500/10 border border-red-500/30 p-4">
                <ul class="space-y-1 text-sm text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 🔥 SCROLLABLE AREA (ONLY THIS SCROLLS) -->
        <div class="mt-6 flex-1 overflow-y-auto pr-2 custom-scrollbar">
            <form id ="registerForm" action="/create-user" method="post" class="space-y-6">
                @csrf

                <div class="flex flex-col gap-6">

                    <div>
                        <label class="block text-sm text-gray-200 mb-1">Full Name</label>
                        <input name="fullname" type="text"
                               class="w-full rounded-lg bg-white/80 px-4 py-2 text-gray-900
                                      focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               placeholder="Enter your full name">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-200 mb-1">Email</label>
                        <input name="email" type="text"
                               class="w-full rounded-lg bg-white/80 px-4 py-2 text-gray-900
                                      focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               placeholder="Enter your email">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-200 mb-1">Username</label>
                        <input name="username" type="text"
                               class="w-full rounded-lg bg-white/80 px-4 py-2 text-gray-900
                                      focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               placeholder="Choose a username">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-200 mb-1">Password</label>
                        <input name="password" type="password"
                               class="w-full rounded-lg bg-white/80 px-4 py-2 text-gray-900
                                      focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               placeholder="Enter a password">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm text-gray-200 mb-1">Confirm Password</label>
                        <input name="cpassword" type="password"
                               class="w-full rounded-lg bg-white/80 px-4 py-2 text-gray-900
                                      focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               placeholder="Confirm your password">
                    </div>

                </div>
            </form>
        </div>

        <!-- FIXED FOOTER -->
        <div class="pt-4 shrink-0">
            <button type="submit" form="registerForm"
                    class="w-full rounded-lg bg-indigo-600 py-2.5 text-white font-semibold
                           hover:bg-indigo-700 transition">
                Sign up
            </button>

            <p class="mt-4 text-center text-sm text-gray-300">
                Already have an account?
                <a href="/" class="text-indigo-400 hover:text-indigo-300">
                    Sign in
                </a>
            </p>
        </div>

    </div>
</div>

</body>
</html>
