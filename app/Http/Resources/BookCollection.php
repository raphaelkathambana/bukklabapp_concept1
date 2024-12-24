<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'cover_image' => $book->cover_image,
                    'language' => $book->language,
                    // Transform authors collection into a comma-separated string
                    'author' => $book->authors->map(fn ($author) => $author->name)->join(', '),
                ];
            }),
            'meta' => [
                'total_books' => $this->collection->count(),
            ],
        ];
    }

}
