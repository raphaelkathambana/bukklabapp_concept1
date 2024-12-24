<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookShelfCollection;
use App\Models\BookShelf;
use Illuminate\Http\Request;

class BookShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $shelves = BookShelf::with(['items:book_shelf_id,book_id'])
            ->where('user_id', $user->id)
            ->get();

        // Return minimal data using BookCollection
        return view('bookshelf.index', [
            'shelves' => BookShelfCollection::make($shelves)->toArray(request()), // Pass to the view
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
    public function show(BookShelf $bookShelf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookShelf $bookShelf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookShelf $bookShelf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookShelf $bookShelf)
    {
        //
    }
}
