<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait GoogleBooksTrait
{
    protected $baseUrl = 'https://www.googleapis.com/books/v1/volumes';
    /**
     * Search for books using the Google Books API.
     *
     * @param string $query
     * @param int $maxResults
     * @return array
     */
    public function searchBooks(string $query, int $maxResults = 10): array
    {
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $query,
            'key' => env('GOOGLE_BOOKS_API_KEY'),
            'maxResults' => $maxResults,
        ]);

        return $response->json()['items'] ?? [];
    }

    /**
     * Fetch detailed information for a specific book by ID.
     *
     * @param string $bookId
     * @return array|null
     */
    public function fetchBookDetails(string $bookId): ?array
    {
        $response = Http::get("https://www.googleapis.com/books/v1/volumes/{$bookId}", [
            'key' => env('GOOGLE_BOOKS_API_KEY'),
        ]);

        return $response->json();
    }

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    /**
     * Transform the Google Books API response into a format suitable for your database.
     *
     * @param array $volumeInfo
     * @return array
     */
    public function transformBookData(array $volumeInfo): array
    {
        return [
            'title' => $volumeInfo['title'] ?? 'Untitled',
            'isbn' => $volumeInfo['industryIdentifiers'][0]['identifier'] ?? null,
            'description' => $volumeInfo['description'] ?? null,
            'cover_image' => $volumeInfo['imageLinks']['thumbnail'] ?? "https://example.com/default-cover.jpg",
            'language' => $volumeInfo['language'] ?? 'unknown',
            'published_date' => ($this->validateDate($volumeInfo['publishedDate']) ? $volumeInfo['publishedDate'] : null) ?? null,
            'pages' => $volumeInfo['pageCount'] ?? null,
        ];
    }
}
