<?php

namespace Tests\Feature;

use Livewire\Livewire;
use App\Livewire\BookSearch;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookSearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_search_and_display_books()
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

        // Test the Livewire component
        Livewire::test(BookSearch::class)
            ->set('query', 'Test')
            ->assertSet('query', 'Test')
            ->assertSee('Test Book')
            ->assertSee('Another Test Book');
    }

    /** @test */
    public function it_can_select_a_book_and_show_details()
    {
        Http::fake([
            'https://www.googleapis.com/books/v1/volumes*' => Http::response([
                'items' => [
                    ['id' => '1', 'volumeInfo' => ['title' => 'Test Book', 'language' => 'en', 'publishedDate' => '2023-01-01', 'pageCount' => 300]],
                ],
            ], 200),
        ]);

        Livewire::test(BookSearch::class)
            ->set('query', 'Test')
            ->call('selectBook', '1')
            ->assertSet('selectedBook.id', '1')
            ->assertSee('Test Book');
    }
}
