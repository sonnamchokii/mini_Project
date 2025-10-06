<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if an admin user already exists using the known admin email
        $adminEmail = 'admin.jnec@rub.edu.bt'; // **IMPORTANT: Use your actual admin email here**

        $admin = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password'), // Use 'password' for testing, you will update this later.
                'role' => 'admin',
                // Removed: 'email_verified_at' => now(), // This line is now removed
            ]
        );

        // If the user was already found, ensure the role is set to 'admin'
        if ($admin->wasRecentlyCreated === false && $admin->role !== 'admin') {
             $admin->forceFill(['role' => 'admin'])->save();
        }

        $this->command->info('Admin user (' . $admin->email . ') successfully created/set to role: admin with password: password');
    }
}