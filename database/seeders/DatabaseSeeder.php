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
        $this->call([
            AdminUserSeeder::class,
            AssetModelSeeder::class,
            AssetSeeder::class, // Add this line
            // Add any other seeders here, e.g., UserSeeder::class
        ]);
    }
}