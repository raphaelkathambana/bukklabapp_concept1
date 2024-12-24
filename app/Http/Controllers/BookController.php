<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\GoogleBooksTrait;
use App\Jobs\FetchBooksJob;
use App\Http\Resources\BookCollection;


class BookController extends Controller
{
    use GoogleBooksTrait;

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = $this->searchBooks($query);

        return view('books.search', compact('books'));
    }
    public function fetchBooksAsync(Request $request)
    {
        $query = $request->input('query');

        // Dispatch the job to fetch books asynchronously
        FetchBooksJob::dispatch($query);

        return response()->json(['message' => 'Books fetching initiated.'], 202);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Fetch books associated with the current user
        $books = Book::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with('authors') // Ensure authors are eager loaded
            ->get(); // Ensure this returns a collection, not a single model

        // Pass the collection to BookCollection
        return view('books.index', [
            'books' => BookCollection::make($books)->toArray(request()), // Explicitly convert to array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
/**
 * <?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{


    public function index()
    {
        $books = Book::with(['authors:id,name'])->get();

        // Return minimal data using BookCollection
        return view('books', [
            'books' => BookCollection::make($books), // Pass to the view
        ]);

    }

}

 */
