<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReadingLog>
 */
class ReadingLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'pages_read' => 50,
            'reading_time' => 60, // in minutes
            'notes' => 'This is a default note for the reading log.',
            'logged_at' => now()->subDays(1),
        ];
    }
}
