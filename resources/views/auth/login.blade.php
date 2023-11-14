<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @livewireScripts
    <title>Login</title>
</head>
<body>
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div class="grid grid-rows-2">
                    <div>
                        <div>
                            <h1 class="text-2xl font-semibold mb-3">Login</h1>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <livewire:auth.login-form/>
                        </div>
                    </div>
                    <div>
                        <div>
                            <h1 class="text-2xl font-semibold mb-3">Register</h1>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <livewire:auth.register-form/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
