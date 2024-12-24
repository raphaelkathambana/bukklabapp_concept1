<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookShelf;
use App\Models\BookShelfItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookShelfItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::pluck('id');

        BookShelf::all()->each(function ($shelf) use ($books) {
            $shelf->items()->createMany(
                $books->random(rand(1, 5))->map(function ($bookId) {
                    return [
                        'book_id' => $bookId,
                        'position' => 1, // Static position
                        'added_at' => now()->subDays(rand(1, 10)),
                    ];
                })->toArray()
            );
        });
    }
}
