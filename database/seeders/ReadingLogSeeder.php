<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\ReadingLog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReadingLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        // Ensure users and books exist
        if ($users->isEmpty() || $books->isEmpty()) {
            $this->command->warn('Skipping ReadingLogSeeder: No Users or Books found.');
            return;
        }

        ReadingLog::factory(50)->create([
            'user_id' => $users->random()->id,
            'book_id' => $books->random()->id,
        ]);
    }
}
