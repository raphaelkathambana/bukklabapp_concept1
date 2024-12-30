<?php

namespace App\Livewire;

use App\Models\BookShelf;
use Livewire\Component;
use App\Traits\GoogleBooksTrait;

class BookSearch extends Component
{
    use GoogleBooksTrait;

    public $query = '';
    public $results = [];
    public $selectedBook = null;
    public $bookshelves = []; // To store the user's bookshelves
    public $selectedBookshelfId = null; // The selected bookshelf ID
    public $showConfirmation = false; // Controls the final confirmation dialog


    public function updatedQuery()
    {
        if (strlen($this->query) > 2) {
            $this->results = $this->searchBooks($this->query);
        }
    }

    public function selectBook($bookId)
    {
        $this->selectedBook = collect($this->results)->firstWhere('id', $bookId);
        // Load the user's bookshelves
        $this->bookshelves = BookShelf::where('user_id', auth()->id())->get();

        // Reset state for the next step
        $this->selectedBookshelfId = null;
        $this->showConfirmation = false;
    }

    public function chooseBookshelf($bookshelfId)
    {
        // Set the selected bookshelf and move to the confirmation step
        $this->selectedBookshelfId = $bookshelfId;
        $this->showConfirmation = true;
    }

    public function confirmBookshelf()
    {
        if (! $this->selectedBookshelfId) {
            session()->flash('error', 'Please select a bookshelf.');
            return redirect()->back();
        }

        \App\Jobs\FetchBooksJob::dispatch(
            $this->selectedBook['id'],
            auth()->id(),
            $this->selectedBookshelfId
        );

        // Reset state after dispatching the job
        $this->reset('selectedBook', 'selectedBookshelfId', 'bookshelves', 'showConfirmation');
        session()->flash('success', 'Book added to your library!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.book-search');
    }
}
