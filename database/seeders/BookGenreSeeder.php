<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::pluck('id');

        Book::all()->each(function ($book) use ($genres) {
            $book->genres()->attach($genres->random(rand(1, 2)));
        });
    }
}
