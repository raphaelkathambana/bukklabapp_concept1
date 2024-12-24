<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('code'); // Get all language codes

        Book::factory(20)->create([
            'language' => $languages->random(), // Use existing languages
        ]);
    }
}
