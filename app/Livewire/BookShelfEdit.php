<?php

namespace App\Livewire;

use App\Models\BookShelf;
use Livewire\Component;

class BookShelfEdit extends Component
{
    public $shelf;
    public $name;
    public $description;
    public $shelfId;

    public function mount($shelf)
    {
        // Fetch the bookshelf details
        $this->shelf = $shelf;
        $this->name = $this->shelf->name;
        $this->description = $this->shelf->description;
    }
    public function render()
    {
        return view('livewire.book-shelf-edit');
    }
}
