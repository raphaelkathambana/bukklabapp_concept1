<div>
    <!-- Search Bar -->
    <input type="text" wire:model.live="query" class="w-full p-2 border rounded" placeholder="Search for books..." />

    <!-- Search Results -->
    <div class="mt-4">
        @foreach ($results as $book)
            <div class="p-4 border rounded shadow-sm">
                <h3 class="text-lg font-bold">{{ $book['volumeInfo']['title'] }}</h3>
                <p>Author(s): {{ implode(', ', $book['volumeInfo']['authors'] ?? ['Unknown']) }}</p>
                <button wire:click="selectBook('{{ $book['id'] }}')"
                    class="mt-2 text-white bg-blue-500 rounded px-4 py-2">
                    Add to Library
                </button>
            </div>
        @endforeach
    </div>

    <!-- Bookshelf Selection Modal -->
    @if ($bookshelves && $selectedBook && !$showConfirmation)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-xl font-bold">Choose a Bookshelf</h3>
                <div class="mt-4 space-y-2">
                    @foreach ($bookshelves as $shelf)
                        <button wire:click="chooseBookshelf({{ $shelf->id }})"
                            class="w-full text-left px-4 py-2 border rounded hover:bg-gray-200">
                            {{ $shelf->name }}
                        </button>
                    @endforeach
                </div>
                <button wire:click="$set('selectedBook', null)" class="mt-4 text-white bg-red-500 rounded px-4 py-2">
                    Cancel
                </button>
            </div>
        </div>
    @endif

    <!-- Confirmation Modal -->
    @if ($showConfirmation)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-xl font-bold">Confirm Selection</h3>
                <p>Selected Book: <strong>{{ $selectedBook['volumeInfo']['title'] }}</strong></p>
                <p>Selected Bookshelf:
                    <strong>{{ $bookshelves->firstWhere('id', $selectedBookshelfId)->name }}</strong>
                </p>
                <button wire:click="confirmBookshelf" class="mt-4 text-white bg-green-500 rounded px-4 py-2">
                    Confirm
                </button>
                <button wire:click="$set('showConfirmation', false)"
                    class="mt-4 text-white bg-red-500 rounded px-4 py-2">
                    Back
                </button>
            </div>
        </div>
    @endif
</div>
