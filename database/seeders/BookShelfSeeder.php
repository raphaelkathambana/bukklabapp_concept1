<?php

namespace Database\Seeders;

use App\Models\BookShelf;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id')->toArray(); // Get all user IDs

        foreach ($users as $userId) {
            for ($i = 1; $i <= 3; $i++) { // Each user gets 3 unique shelves
                BookShelf::create([
                    'user_id' => $userId,
                    'name' => "Shelf $i for User $userId", // Unique shelf name per user
                    'description' => "This is shelf $i for user $userId.",
                    'is_public' => rand(0, 1),
                ]);
            }
        }
    }
}
