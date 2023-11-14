<!doctype html>
<html xmlns:livewire="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @livewireScripts
    <title>Home | Posts</title>
</head>
<body>
<div class="min-h-screen bg-gray-100 p-2 flex flex-col">
    <div class="relative sm:max-w-xl row ">
        <form action="{{ url('/logout') }}" method="post">
            @csrf
            <button
                class="btn"
                type="submit">Logout
            </button>
            <a href="{{ url('/posts') }}"
               class="btn ml-3"
               type="submit">Back
            </a>
        </form>
    </div>
    <div class="relative my-2">

        <livewire:post/>
    </div>
    <div class="relative my-2">
        <livewire:comment-form/>
        @for ($i = 0; $i < 10; $i++)
            <livewire:comment/>
        @endfor
    </div>
</div>
</body>
</html>
