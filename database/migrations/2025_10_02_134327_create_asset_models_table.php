<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the 'asset_models' table to store specifications (e.g., "MacBook Pro M2").
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('manufacturer')->nullable();
            $table->integer('depreciation_period')->nullable()->comment('Years until depreciation');
            $table->boolean('is_requestable')->default(true)->comment('If users can request this model');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_models');
    }
};