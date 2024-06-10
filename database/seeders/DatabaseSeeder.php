<?php

namespace Database\Seeders;

use App\Models\{Question, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        Question::factory()->count(10)->create();
    }
}
