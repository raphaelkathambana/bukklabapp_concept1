<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-text-800 dark:text-text-200">
            {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-background-50 dark:bg-background-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="max-w-4xl mx-auto mt-10 shadow-lg rounded-lg p-6 bg-background-100 dark:bg-background-900">
                    <!-- Book Cover and Title -->
                    <div class="flex flex-col md:flex-row items-start md:items-center">
                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                            class="w-48 h-64 object-cover rounded-md shadow-md mb-4 md:mb-0" />
                        <div class="ml-6">
                            <h1 class="text-2xl font-bold text-text-800 dark:text-text-200">{{ $book->title }}</h1>
                            <p class="text-lg text-text-600 dark:text-text-300">by
                                @foreach ($book->authors as $author)
                                    <span class="text-secondary-500 dark:text-secondary-300">{{ $author->name }}</span>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold text-primary-600 dark:text-primary-400">Description</h2>
                        <p class="text-text-700 dark:text-text-300 mt-2">
                            {!! $book->description ?? 'No description available for this book.' !!}
                        </p>
                    </div>

                    <!-- Stats and Reading Status -->
                    <div class="mt-6 flex flex-wrap gap-6">
                        <!-- Stats -->
                        <div class="bg-background-200 dark:bg-background-700 p-4 rounded-lg shadow-md w-full md:w-1/3">
                            <h2 class="text-lg font-semibold text-primary-600 dark:text-primary-400">Book Stats</h2>
                            <ul class="mt-2 text-text-700 dark:text-text-300">
                                <li><strong>Pages:</strong> {{ $book->pages ?? 'N/A' }}</li>
                                <li><strong>Language:</strong> {{ $book->language ?? 'Unknown' }}</li>
                                <li><strong>Published:</strong> {{ $book->published_date ?? 'Unknown' }}</li>
                            </ul>
                        </div>

                        <!-- Status -->
                        <div class="bg-primary-50 dark:bg-primary-900 p-4 rounded-lg shadow-md w-full md:w-1/3">
                            <h2 class="text-lg font-semibold text-primary-700 dark:text-primary-300">Reading Status</h2>
                            <p class="text-text-700 dark:text-text-300 mt-2">
                                <strong>Status:</strong> {{ ucfirst($userBook->status ?? 'Not Started') }}
                            </p>
                            @if ($userBook->status === 'reading')
                                <p class="text-text-700 dark:text-text-300"><strong>Started On:</strong>
                                    {{ $userBook->started_at ?? 'Unknown' }}</p>
                            @elseif ($userBook->status === 'completed')
                                <p class="text-text-700 dark:text-text-300"><strong>Completed On:</strong>
                                    {{ $userBook->completed_at ?? 'Unknown' }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Call-to-Action: Log Reading Progress -->
                    <div class="mt-6 bg-accent-50 dark:bg-accent-900 p-6 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-accent-600 dark:text-accent-300">Log Your Progress</h2>
                        <form wire:submit.prevent="logProgress">
                            <div class="mt-4">
                                <label for="progress" class="block text-text-700 dark:text-text-300">Pages Read
                                    Today</label>
                                <input type="number" id="progress" wire:model="pagesReadToday"
                                    class="form-input w-full mt-2 border-accent-300 dark:border-accent-500 rounded-md shadow-sm focus:ring focus:ring-accent-200 dark:focus:ring-accent-700" />
                                @error('pagesReadToday')
                                    <span class="text-sm text-danger-500 dark:text-danger-300">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="notes" class="block text-text-700 dark:text-text-300">Notes or
                                    Reflections</label>
                                <textarea id="notes" wire:model="readingNotes" rows="4"
                                    class="form-textarea w-full mt-2 border-accent-300 dark:border-accent-500 rounded-md shadow-sm focus:ring focus:ring-accent-200 dark:focus:ring-accent-700"></textarea>
                            </div>

                            <button type="submit"
                                class="mt-4 bg-accent-500 dark:bg-accent-700 text-white px-4 py-2 rounded-md shadow-md hover:bg-accent-400 dark:hover:bg-accent-600">
                                Log Progress
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
