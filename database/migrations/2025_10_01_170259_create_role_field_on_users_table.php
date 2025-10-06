<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// NOTE: The class name (e.g., CreateRoleFieldOnUsersTable) MUST match the part of the file name
// after the timestamp to be correctly loaded by Laravel.
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the 'role' column to the 'users' table.
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the 'role' column if the migration is rolled back.
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};