<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hanya panggil AdminSeeder, tidak ada seeder lain
        $this->call(AdminSeeder::class);
    }
}