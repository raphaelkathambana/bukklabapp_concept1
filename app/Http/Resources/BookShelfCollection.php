<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookShelfCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($shelf) {
                return [
                    'id' => $shelf->id,
                    'name' => $shelf->name,
                    'description' => $shelf->description,
                    'items' => $shelf->items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'book_id' => $item->book_id,
                            'book' => [
                                'title' => $item->book->title,
                                'author' => $item->book->authors->map(fn ($author) => $author->name)->join(', '),
                                'published_year' => $item->book->published_year,
                            ],
                        ];
                    }),
                ];
            }),
            'meta' => [
                'total_shelves' => $this->collection->count(),
            ],
        ];
    }
}
