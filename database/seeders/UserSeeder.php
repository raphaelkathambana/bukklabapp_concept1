<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([ // Creates a user with the following data
            'name' => 'JJ Kathambana',
            'email' => 'jjkathambana@gmail.com',
        ]);
        User::factory(9)->create(); // Creates 10 users
    }
}
