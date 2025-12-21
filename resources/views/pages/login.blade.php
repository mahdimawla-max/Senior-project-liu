<!doctype html>
<html lang="en">
<head>
    <!-- Basic meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Tailwind via Vite -->
    @vite('resources/css/app.css')

    <title>Login</title>
</head>

<!-- Background: modern gradient -->
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-blue-900 to-slate-900 flex items-center justify-center">

<div class="w-full max-w-md px-6">

    <!-- Login card -->
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-8">

        <!-- Title -->
        <h2 class="text-center text-3xl font-bold text-white">
            Welcome back
        </h2>

        <!-- Subtitle -->
        <p class="mt-2 text-center text-sm text-gray-300">
            Sign in to continue
        </p>

        <!-- Login form (logic untouched) -->
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="post">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-200">
                    Email address
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="Enter your email"
                    class="mt-1 w-full rounded-lg bg-white/80 px-4 py-2 text-gray-900
                           placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">
                    Password
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                    class="mt-1 w-full rounded-lg bg-white/80 px-4 py-2 text-gray-900
                           placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <!-- Remember me -->
            <div class="flex items-center">
                <input
                    id="remember_me"
                    name="remember_me"
                    type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                >
                <label for="remember_me" class="ml-2 text-sm text-gray-200">
                    Remember me
                </label>
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full rounded-lg bg-indigo-600 py-2.5 text-white font-semibold
                       hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
                Sign in
            </button>
        </form>

        <!-- Register link -->
        <p class="mt-6 text-center text-sm text-gray-300">
            Don’t have an account?
            <a href="/register" class="font-medium text-indigo-400 hover:text-indigo-300">
                Create one
            </a>
        </p>

    </div>
</div>

</body>
</html>
