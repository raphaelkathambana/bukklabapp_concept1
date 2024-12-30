<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Traits\GoogleBooksTrait;

class GoogleBooksTraitTest extends TestCase
{
    use GoogleBooksTrait;

    /** @test */
    public function it_can_search_books()
    {
        // Mock the Google Books API response
        Http::fake([
            'https://www.googleapis.com/books/v1/volumes*' => Http::response([
                'items' => [
                    ['id' => '1', 'volumeInfo' => ['title' => 'Test Book']],
                    ['id' => '2', 'volumeInfo' => ['title' => 'Another Test Book']],
                ],
            ], 200),
        ]);

        // Call the trait's method
        $results = $this->searchBooks('Test');

        // Assertions
        $this->assertCount(2, $results);
        $this->assertEquals('Test Book', $results[0]['volumeInfo']['title']);
        $this->assertEquals('Another Test Book', $results[1]['volumeInfo']['title']);
    }

    /** @test */
    public function it_can_fetch_book_details()
    {
        // Mock the Google Books API response
        Http::fake([
            'https://www.googleapis.com/books/v1/volumes/*' => Http::response([
                'volumeInfo' => [
                    'title' => 'Detailed Test Book',
                    'authors' => ['Author One', 'Author Two'],
                ],
            ], 200),
        ]);

        // Call the trait's method
        $details = $this->fetchBookDetails('1');

        // Assertions
        $this->assertEquals('Detailed Test Book', $details['volumeInfo']['title']);
        $this->assertContains('Author One', $details['volumeInfo']['authors']);
    }
}
