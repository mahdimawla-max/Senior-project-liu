<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
<div class="max-w-4xl max-sm:max-w-lg mx-auto font-[sans-serif] p-6">
    <div class="text-center mb-12 sm:mb-16">

        <h4 class="text-gray-600 text-base mt-6">Sign up into your account</h4>
    </div>
    <div class="alert alert-danger" id="erros">
    @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
    @endif
    </div>
    <form action="/create-user" method="post">
        @csrf
        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label class="text-gray-600 text-sm mb-2 block">Full Name</label>
                <input name="fullname" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter name" />
            </div>

            <div>
                <label class="text-gray-600 text-sm mb-2 block">Email</label>
                <input name="email" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter email" />
            </div>
            <div>
                <label class="text-gray-600 text-sm mb-2 block">User Name</label>
                <input name="username" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter user name" />
            </div>
            <div>
                <label class="text-gray-600 text-sm mb-2 block">Password</label>
                <input name="password" type="password" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter password" />
            </div>
            <div>
                <label class="text-gray-600 text-sm mb-2 block">Confirm Password</label>
                <input name="cpassword" type="password" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter confirm password" />
            </div>
        </div>

        <div class="mt-8">
            <button  class="mx-auto block py-3 px-6 text-sm tracking-wider rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                Sign up
            </button>
        </div>
    </form>
</div>
<script>

</script>
</body>
</html>
