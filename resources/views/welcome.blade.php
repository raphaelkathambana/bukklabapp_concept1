<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buk Klab Base</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background-50 dark:bg-background-900 text-text-700 dark:text-text-200">
    <div class="bg-background-50 text-text-700 dark:bg-background-900 dark:text-text-200">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-secondary-400 selection:text-text-50">
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
                    <div class="container py-32 mx-auto text-center sm:px-4">
                        <h1
                            class="text-4xl font-extrabold leading-10 tracking-tight text-primary-500 dark:text-primary-300 sm:text-5xl sm:leading-none md:text-6xl xl:text-7xl">
                            <span class="block">Simplify the way you</span>
                            <span class="relative inline-block mt-3 text-accent-500 dark:text-accent-300">track your
                                reading</span>
                        </h1>
                        <div
                            class="max-w-lg mx-auto mt-6 text-sm text-text-500 dark:text-text-300 md:mt-12 sm:text-base md:max-w-xl md:text-lg xl:text-xl">
                            A fun and better way to track your book reads, manage your logs, and read, read, read!!!
                        </div>
                        <div
                            class="relative flex items-center max-w-md mx-auto mt-12 overflow-hidden text-center rounded-full bg-background-100 dark:bg-background-700">
                            <input type="text" name="email" placeholder="Email Address"
                                class="w-full h-12 px-6 py-2 font-medium text-primary-700 dark:text-primary-300 focus:outline-none" />
                            <span class="relative top-0 right-0 block">
                                <button type="button"
                                    class="inline-flex items-center w-32 h-12 px-8 text-base font-bold leading-6 text-text-50 transition duration-150 ease-in-out bg-primary-500 hover:bg-primary-700 dark:bg-primary-700 dark:hover:bg-primary-500 focus:outline-none">
                                    Sign Up
                                </button>
                            </span>
                        </div>
                        <div class="mt-8 text-sm text-text-500 dark:text-text-300">By signing up, you agree to our terms
                            and
                            services.</div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>
