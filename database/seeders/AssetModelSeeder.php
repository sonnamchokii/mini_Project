<?php

namespace Database\Seeders;

use App\Models\AssetModel;
use Illuminate\Database\Seeder;

class AssetModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetModel::firstOrCreate(
            ['name' => 'MacBook Pro 14-inch M2'],
            [
                'manufacturer' => 'Apple',
                'depreciation_period' => 4,
                'is_requestable' => true,
                'description' => 'High-performance laptop for demanding tasks.',
            ]
        );

        AssetModel::firstOrCreate(
            ['name' => 'Dell Latitude 7420'],
            [
                'manufacturer' => 'Dell',
                'depreciation_period' => 3,
                'is_requestable' => true,
                'description' => 'Standard business laptop, reliable and portable.',
            ]
        );

        AssetModel::firstOrCreate(
            ['name' => 'HP EliteDisplay E24 G4'],
            [
                'manufacturer' => 'HP',
                'depreciation_period' => 5,
                'is_requestable' => true,
                'description' => '24-inch Full HD monitor with ergonomic stand.',
            ]
        );

        AssetModel::firstOrCreate(
            ['name' => 'Logitech MX Master 3S'],
            [
                'manufacturer' => 'Logitech',
                'depreciation_period' => 2,
                'is_requestable' => false, // Not requestable directly, might be an accessory
                'description' => 'Advanced wireless mouse for productivity.',
            ]
        );

        $this->command->info('Asset models seeded!');
    }
}
