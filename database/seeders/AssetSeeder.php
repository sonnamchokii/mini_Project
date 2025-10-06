<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure you have an AssetModel to link to
        $macbookModel = AssetModel::firstOrCreate(
            ['name' => 'MacBook Pro 14-inch M2'],
            ['manufacturer' => 'Apple', 'depreciation_period' => 4, 'is_requestable' => true]
        );

        $dellModel = AssetModel::firstOrCreate(
            ['name' => 'Dell Latitude 7420'],
            ['manufacturer' => 'Dell', 'depreciation_period' => 3, 'is_requestable' => true]
        );

        // Create a regular user if one doesn't exist
        $regularUserEmail = 'user@example.com';
        $regularUser = User::firstOrCreate(
            ['email' => $regularUserEmail],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'), // Or any default password
                'role' => 'user',
                // Removed: 'email_verified_at' => now(), // This line is now removed
            ]
        );

        // Assign some assets to the regular user
        Asset::firstOrCreate(
            ['asset_tag' => 'LT001'],
            [
                'serial' => 'SNMAC001',
                'model_id' => $macbookModel->id,
                'user_id' => $regularUser->id,
                'status' => 'Assigned',
                'checked_out_at' => now()->subDays(10),
                'notes' => 'Assigned to Regular User for daily work.',
            ]
        );

        Asset::firstOrCreate(
            ['asset_tag' => 'LT002'],
            [
                'serial' => 'SNDELL001',
                'model_id' => $dellModel->id,
                'user_id' => $regularUser->id,
                'status' => 'Assigned',
                'checked_out_at' => now()->subDays(5),
                'notes' => 'Secondary laptop for Regular User.',
            ]
        );

        // Create some available assets not assigned to anyone
        Asset::firstOrCreate(
            ['asset_tag' => 'LT003'],
            [
                'serial' => 'SNMAC002',
                'model_id' => $macbookModel->id,
                'user_id' => null, // Not assigned
                'status' => 'Available',
                'checked_out_at' => null,
                'notes' => 'Available for new assignments.',
            ]
        );

        Asset::firstOrCreate(
            ['asset_tag' => 'MN001'],
            [
                'serial' => 'SNMON001',
                'model_id' => AssetModel::firstOrCreate(['name' => 'HP EliteDisplay E24 G4'], ['manufacturer' => 'HP', 'depreciation_period' => 5, 'is_requestable' => true])->id,
                'user_id' => null,
                'status' => 'Available',
                'checked_out_at' => null,
                'notes' => 'Monitor in stock.',
            ]
        );

        $this->command->info('Assets and a regular user seeded!');
    }
}