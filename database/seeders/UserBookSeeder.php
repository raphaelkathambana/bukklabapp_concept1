<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id')->toArray(); // Fetch all user IDs
        $books = Book::pluck('id')->toArray(); // Fetch all book IDs

        // Shuffle the arrays to ensure unique combinations
        shuffle($users);
        shuffle($books);

        // Use combinations of user and book to ensure uniqueness
        $pairs = [];
        foreach ($users as $userId) {
            foreach (array_slice($books, 0, rand(1, 5)) as $bookId) { // Limit to 5 unique pairs per user
                if (!isset($pairs[$userId])) {
                    $pairs[$userId] = [];
                }

                if (!in_array($bookId, $pairs[$userId])) {
                    $pairs[$userId][] = $bookId;
                    UserBook::create([
                        'user_id' => $userId,
                        'book_id' => $bookId,
                        'status' => 'reading',
                        'current_page' => rand(1, 300),
                        'started_at' => now()->subDays(rand(1, 30)),
                        'completed_at' => rand(0, 1) ? now()->subDays(rand(1, 10)) : null,
                    ]);
                }
            }
        }
    }
}
