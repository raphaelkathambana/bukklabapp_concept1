<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\BookAuthor;
use App\Http\Resources\GenreResource;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isbn' => $this->isbn,
            'pages' => $this->pages,
            'description' => $this->description,
            'cover_image' => $this->cover_image,
            'language' => $this->language,
            'published_date' => $this->published_date,
            'authors' => AuthorResource::collection($this->whenLoaded('authors')), // Full detailed relationship
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
            'series_id' => $this->series_id,
            'series_order' => $this->series_order,
        ];
    }
}
