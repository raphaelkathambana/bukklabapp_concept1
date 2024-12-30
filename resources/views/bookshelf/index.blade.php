<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-text-800 dark:text-text-200">
            {{ __('My Collections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-background-50 dark:bg-background-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-text-700 dark:text-text-300">
                    {{ __('In this page, you will see a collage of the collections you have for your books') }}

                    <div class="grid grid-cols-1 px-4 py-3 xl:grid-cols-3 gap-9">
                        @if (isset($shelves) && is_iterable($shelves))
                            @foreach ($shelves['data'] as $shelf)
                                <div x-data="{ open: false }"
                                    class="overflow-hidden bg-background-100 dark:bg-background-700 rounded-lg shadow-md">
                                    <div class="p-4">
                                        <h2 class="text-xl font-semibold text-text-800 dark:text-text-200">
                                            {{ $shelf['name'] }}</h2>
                                        <p class="mt-1 text-text-600 dark:text-text-400">{{ $shelf['description'] }}</p>
                                        <button @click="open = !open"
                                            class="flex items-center mt-3 font-medium text-primary-500 dark:text-primary-300 hover:text-primary-700 dark:hover:text-primary-400">
                                            <span x-text="open ? 'Hide books' : 'Show books'"></span>
                                            <svg class="w-4 h-4 ml-1 transition-transform duration-200"
                                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <div x-show="open" x-collapse
                                        class="px-4 py-3 bg-background-200 dark:bg-background-600">
                                        <ul class="space-y-2">
                                            @foreach ($shelf['items'] as $item)
                                                <li class="flex items-center">
                                                    <span class="w-2 h-2 mr-2 bg-accent-500 rounded-full"></span>
                                                    <span
                                                        class="text-text-700 dark:text-text-300">{{ $item['book']['title'] }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="flex justify-end pt-4">
                                        <a href="{{ route('bookshelves.show', [$shelf['id']]) }}"
                                            class="bg-primary-500 dark:bg-primary-700 text-text-50 font-bold text-lg p-3 rounded-lg hover:bg-primary-700 dark:hover:bg-primary-500 active:scale-95 transition-transform transform">
                                            {{ __('View Shelf') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-text-600 dark:text-text-400">{{ __('No shelves available.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
