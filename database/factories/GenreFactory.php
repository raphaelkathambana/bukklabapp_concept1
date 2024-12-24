<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $uniqueGenres = ['Fiction', 'Non-Fiction', 'Science Fiction', 'Fantasy', 'Mystery'];

        return [
            'name' => array_shift($uniqueGenres), // Shift ensures each call uses a unique value
            'description' => 'This is a default description for the genre.',
        ];
    }
}
