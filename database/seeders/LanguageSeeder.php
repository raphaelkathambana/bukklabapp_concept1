<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::factory()->create(['code' => 'en', 'name' => 'English']);
        Language::factory()->create(['code' => 'es', 'name' => 'Spanish']);
        Language::factory()->create(['code' => 'fr', 'name' => 'French']);
    }
}
