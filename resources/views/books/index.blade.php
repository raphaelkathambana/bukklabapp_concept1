<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-text-800 dark:text-text-200">
            {{ __('Books') }}
            <a href="{{ route('books.search') }}" class="text-primary-500 dark:text-primary-300 hover:underline">
                {{ __('Search Books') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-background-50 dark:bg-background-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-text-700 dark:text-text-300">
                    {{ __('In this page, you will see a collage of all the books you have on your shelves') }}

                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3">
                        @if (isset($books) && is_iterable($books))
                            @foreach ($books['data'] as $book)
                                <x-book-card :title="$book['title']" :author="$book['author']" :cover="$book['cover_image']" :language="$book['language']"
                                    :id="$book['id']" />
                            @endforeach
                        @else
                            <p class="text-text-600 dark:text-text-400">{{ __('No books available.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
