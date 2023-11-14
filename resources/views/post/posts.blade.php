<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @livewireScripts
    <title>Home | Posts</title>
</head>
<body>
<div class="min-h-screen bg-gray-100 p-2 flex flex-col">
    <div class="relative sm:max-w-xl ">
        <form action="{{ url('/logout') }}" method="post">
            @csrf
            <button
                class="btn"
                type="submit">Logout
            </button>
        </form>
    </div>
    <div class="relative my-2">
        <livewire:post-list/>
    </div>
</div>
</body>
</html>
