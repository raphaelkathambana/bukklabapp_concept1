<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BookShelf;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookShelfItem>
 */
class BookShelfItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_shelf_id' => BookShelf::factory(),
            'book_id' => Book::factory(),
            'position' => 1,
            'added_at' => now()->subDays(3),
        ];

    }
}
