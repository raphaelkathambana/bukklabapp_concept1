<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            UserSeeder::class,
            AuthorSeeder::class,
            GenreSeeder::class,
            BookSeeder::class,
            ReadingLogSeeder::class,
            UserBookSeeder::class,
            BookAuthorSeeder::class,
            BookGenreSeeder::class,
            BookShelfSeeder::class,
            BookShelfItemSeeder::class,
        ]);
    }
}
