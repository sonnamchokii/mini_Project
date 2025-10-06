<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('asset_models', function (Blueprint $table) {
            $table->string('description')->nullable()->after('is_requestable');
            $table->string('category')->nullable()->after('manufacturer'); // Or wherever you prefer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asset_models', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('category');
        });
    }
};