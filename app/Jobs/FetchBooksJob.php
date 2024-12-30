<?php

namespace App\Jobs;

use App\Models\BookShelfItem;
use App\Traits\GoogleBooksTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Book;
use App\Models\Author;
use App\Models\Language;
use Illuminate\Support\Facades\Http;

class FetchBooksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GoogleBooksTrait;

    public $bookId;
    public $userId;
    public $shelfId;

    public function __construct($bookId, $userId, $shelfId)
    {
        $this->bookId = $bookId;
        $this->userId = $userId;
        $this->shelfId = $shelfId;
    }

    public function handle()
    {
        // Fetch detailed book data
        $bookData = $this->fetchBookDetails($this->bookId);


        if (empty($bookData['volumeInfo']) && empty($bookData['items'][0]['volumeInfo'])) {
            dd($bookData);
            throw new \App\Exceptions\InvalidBookDataException('Invalid book data from API');
        } elseif (!empty($bookData['items'][0]['volumeInfo'])) {
            $bookData = $bookData['items'][0];
        }
        $volumeInfo = $bookData['volumeInfo'];
        $transformedBook = $this->transformBookData($volumeInfo);

        // Check and add the Language to the database
        $language = Language::firstOrCreate(
            ['code' => $transformedBook['language']]
            );
        $transformedBook['language_id'] = $language->id;

        // Add book to the database
        $book = Book::firstOrCreate(
            ['isbn' => $transformedBook['isbn']],
            $transformedBook
        );

        // Add authors to the database
        if (isset($volumeInfo['authors'])) {
            foreach ($volumeInfo['authors'] as $authorName) {
                $author = Author::firstOrCreate(['name' => $authorName]);
                $book->authors()->syncWithoutDetaching([$author->id]);
            }
        }

        // Add user-book relationship
        $book->users()->syncWithoutDetaching([
            $this->userId => [
                'status' => 'to-read',
                'started_at' => null,
                'completed_at' => null,
            ],
        ]);

        // Determine the next position in the bookshelf
        $lastPosition = BookShelfItem::where('book_shelf_id', $this->shelfId)
            ->max('position') ?? 0;
        $nextPosition = $lastPosition + 1;

        // Add book to bookshelf
        $book->shelfItems()->create([
            'book_shelf_id' => $this->shelfId,
            'added_at' => now(),
            'position' => $nextPosition,
        ]);
    }
}
