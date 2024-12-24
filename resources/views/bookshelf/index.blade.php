<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('My Bookshelf Collections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('In this page, you will see a collage of the books you have on your self: to read, reading, paused and dead') }}

                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3">
                        @if (isset($shelves) && is_iterable($shelves))
                            @foreach ($shelves['data'] as $shelf)
                                <div>
                                    <h3>{{ $shelf['name'] }}</h3>
                                    <p>{{ $shelf['description'] }}</p>
                                    <ul>
                                        @foreach ($shelf['items'] as $item)
                                            <li>{{ $item['book']['title'] }} by {{ $item['book']['author'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <p>No shelves available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
