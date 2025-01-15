<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\BookShelf;
use Livewire\Component;

class BookShelfDetails extends Component
{
    public string $search = '';
    public $shelfId;
    public $bookId;
    public $books;
    public $showConfirmation = false;
    public $selectedBook = '';

    public function updatedSearch() {
        $this->books = Book::with('authors')->search($this->search)->get();
    }

    public function searchBooks()
    {
        $this->books = Book::all();
        $this->selectedBook = '';
    }

    public function addBook($bookId)
    {
        $shelf = BookShelf::findOrFail($this->shelfId);
        $shelf->items()->attach($bookId);
    }

    public function removeBook($bookId)
    {
        $shelf = BookShelf::findOrFail($this->shelfId);
        $shelf->items()->detach($bookId);
    }

    public function confirmRemoval($bookId)
    {
        $this->bookId = $bookId;
        $this->showConfirmation = true;
    }

    public function cancelRemoval()
    {
        $this->showConfirmation = false;
    }

    public function render()
    {
        return view('livewire.book-shelf-details')->with(
            'shelf',
            BookShelf::with(['items:book_shelf_id,book_id'])
                ->where('id', $this->shelfId)
                ->firstOrFail()
        );
    }
}
