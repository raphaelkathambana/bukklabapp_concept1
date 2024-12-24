<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buk Klab Base</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid items-center grid-cols-2 gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <a href="/" class="flex items-center space-x-2">
                            ⭐
                        </a>
                    </div>
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </header>

                <main class="mt-6">
                        <div class="container py-32 mx-auto text-center sm:px-4 tails-selected-element"
                            contenteditable="true">

                            <h1
                                class="text-4xl font-extrabold leading-10 tracking-tight text-white sm:text-5xl sm:leading-none md:text-6xl xl:text-7xl">
                                <span class="block">Simplify the way you</span> <span
                                    class="relative inline-block mt-3 text-white">track your reading</span></h1>
                            <div class="max-w-lg mx-auto mt-6 text-sm text-center text-indigo-200 md:mt-12 sm:text-base md:max-w-xl md:text-lg xl:text-xl"
                                data-primary="indigo-200">A fun and better way to track your book reads, manage your
                                logs and read, read, read!!!</div>
                            <div data-rounded="rounded-full"
                                class="relative flex items-center max-w-md mx-auto mt-12 overflow-hidden text-center rounded-full">
                                <input type="text" name="email" placeholder="Email Address"
                                    class="w-full h-12 px-6 py-2 font-medium text-indigo-800 focus:outline-none"
                                    data-primary="indigo-800" wfd-id="id0">
                                <span class="relative top-0 right-0 block">
                                    <button type="button"
                                        class="inline-flex items-center w-32 h-12 px-8 text-base font-bold leading-6 text-white transition duration-150 ease-in-out bg-indigo-400 border border-transparent hover:bg-indigo-700 focus:outline-none active:bg-indigo-700 lg:bg-stone-500"
                                        data-primary="indigo-600">
                                        Sign Up
                                    </button>
                                </span>
                            </div>
                            <div class="mt-8 text-sm text-indigo-300" data-primary="indigo-600">By signing up, you agree
                                to our terms and services.</div>
                        </div>
                </main>


            </div>
        </div>
    </div>
</body>

</html>
