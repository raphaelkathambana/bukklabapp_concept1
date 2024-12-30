<?php

namespace Tests\Unit;

use App\Jobs\FetchBooksJob;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;
use App\Models\BookShelf;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FetchBooksJobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_and_persist_book_data()
    {
        // Create a user and a bookshelf
        $user = User::factory()->create();
        $shelf = BookShelf::factory()->create(['user_id' => $user->id]);

        // Mock the Google Books API response
        Http::fake([
            'https://www.googleapis.com/books/v1/volumes/*' => Http::response([
                'id' => '1',
                'kind' => 'books#volume',
                'volumeInfo' => [
                    'title' => 'Test Book',
                    'authors' => ['Author One', 'Author Two'],
                    'industryIdentifiers' => [['identifier' => '1234567890']],
                    'imageLinks' => ['thumbnail' => 'test-thumbnail.jpg'],
                    'language' => 'en',
                    'publishedDate' => '2023-01-01',
                    'pageCount' => 300,
                ],
            ], 200),
        ]);

        // Dispatch the job
        FetchBooksJob::dispatchSync('1', $user->id, $shelf->id);

        // Assertions
        // Check the book exists in the database
        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'isbn' => '1234567890',
            'cover_image' => 'test-thumbnail.jpg',
        ]);

        // Check the authors exist and are linked to the book
        $this->assertDatabaseHas('authors', ['name' => 'Author One']);
        $this->assertDatabaseHas('authors', ['name' => 'Author Two']);
        $book = Book::first();
        $this->assertCount(2, $book->authors);

        // Check user-book relationship
        $this->assertDatabaseHas('user_books', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'to-read',
        ]);

        // Check book is added to the shelf
        $this->assertDatabaseHas('book_shelf_items', [
            'book_shelf_id' => $shelf->id,
            'book_id' => $book->id,
        ]);
    }
}
