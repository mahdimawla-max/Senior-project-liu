<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
    <div class="max-w-2xl mx-auto px-4">
        @foreach($data as $item)
            <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900" style="border-top: rgb(55 65 81 / var(--tw-border-opacity, 1));">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img
                                class="mr-2 w-6 h-6 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                alt="Michael Gough">{{$item->fullname}}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                                                                  title="February 8th, 2022">Feb. 8, 2022</time></p>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">{{$item->comment}}</p>
            </article>
        @endforeach
    </div>
</section>
</body>
</html>
