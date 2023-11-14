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
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <form action="http://127.0.0.1:8000/logout" method="post">
            @csrf
            <button
                class="btn"
                type="submit">Logout
            </button>
        </form>
    </div>
</div>
</body>
</html>
