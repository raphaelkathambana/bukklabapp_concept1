<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Default Book Title',
            'isbn' => fake()->isbn13(),
            'pages' => 300,
            'description' => 'This is a default description for the book.',
            'cover_image' => 'https://example.com/default-cover.jpg',
            'language' => 'en',
            'published_date' => now()->subYears(5),
        ];
    }
}
