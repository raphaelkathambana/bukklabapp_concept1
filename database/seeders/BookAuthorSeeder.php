<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::pluck('id');

        Book::all()->each(function ($book) use ($authors) {
            $book->authors()->attach(
                $authors->random(rand(1, 3)),
                ['author_order' => 1] // Author order is consistent
            );
        });
    }
}
