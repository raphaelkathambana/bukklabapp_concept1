<!-- filepath: /c:/Users/maya1/codespaces/webdev/bukklabapp/concept1/resources/views/livewire/book-shelf-details.blade.php -->
<div class="p-6 bg-background-100 dark:bg-background-900">
    <div class="mt-4">
        <h2 class="text-xl font-bold text-primary-600 dark:text-primary-400 font-heading">Shelf Details</h2>
        <p class="mt-2 text-text-700 dark:text-text-300">{{ $shelf->description }}</p>
        <p class="mt-2 font-body">Created: {{ $shelf->created_at->diffForHumans() }}</p>
        <p class="font-body">Updated: {{ $shelf->updated_at->diffForHumans() }}</p>
    </div>
    <h1 class="text-xl text-text-700 dark:text-text-300 font-body">Total Items: {{ $shelf->items->count() }}</h1>
    <div class="mt-4">
        <h2 class="text-xl font-bold text-primary-600 dark:text-primary-400 font-heading">Shelf Items</h2>
        <div class="mt-4">
            <button href="{{ route('bookshelves.shelves.books.add', $shelf->id) }}" wire:click="searchBooks"
                class="mt-2 text-white bg-primary-500 dark:bg-primary-700 rounded px-4 py-2">Add Book</button>
            <!-- Book Selection Modal -->
            @if ($books && !$showConfirmation && !$selectedBook)
                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white dark:bg-background-900 p-6 rounded shadow text-text-700 dark:text-text-300">
                        <h3 class="text-xl font-bold font-heading">Choose a Book</h3>
                        <div class="mt-4">
                            <input wire:model.live="search" type="text"
                                class="w-full p-2 border rounded bg-background-100 dark:bg-background-900 text-text-700 dark:text-text-300"
                                placeholder="Search for books..." />
                            <div class="mt-4 space
                            -y-2">
                                @foreach ($books as $book)
                                    <button wire:click="addBook({{ $book->id }})"
                                        class="w-full text-left px-4 py-2 border rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                                        {{ $book->title }}
                                    </button>
                                @endforeach
                            </div>
                            <button wire:click="$set('selectedBook', 'null')"
                                class="mt-4 text-white bg-red-500 dark:bg-red-700 rounded px-4 py-2">
                                Cancel
                            </button>
                        </div>
                    </div>
            @endif
        </div>
        <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($shelf->items as $item)
                <div
                    class="p-4 border
                    rounded shadow-sm bg-background-100 dark:bg-background-900 text-text-700 dark:text-text-300">
                    <h3 class="text-lg font-bold font-heading">{{ $item->book->title }}</h3>
                    <p class="font-body">Author(s):
                        @foreach ($item->book->authors as $author)
                            <span class="text-secondary-500 dark:text-secondary-300">{{ $author->name }}</span>
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </p>
                    <p class="font-body">Published: {{ $item->book->publishedDate }}</p>
                    <p class="font-body">ISBN: {{ $item->book->isbn }}</p>
                    <div>
                        <a href="{{ route('books.show', $item->book) }}"
                            class="mt-2 text-white bg-primary-500 dark:bg-primary-700 rounded px-4 py-2">View</a>
                        <a href="{{ route('bookshelves.shelves.books.remove', ['book_id' => $item->book->id, 'shelf_id' => $shelf->id]) }}"
                            class="mt-2 text-white bg-red-500 dark:bg-red-700 rounded px-4 py-2">Remove</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
