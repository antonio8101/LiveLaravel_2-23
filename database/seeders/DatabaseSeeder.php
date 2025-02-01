<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Factory per multipli elementi
        User::factory(100)->create();

        // Factory per un item, con sostituzione
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Chiamata ad altri Seeder
        $this->call([
            PostSeeder::class,
        ]);
    }
}
