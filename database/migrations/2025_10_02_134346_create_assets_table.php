<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the 'assets' table to store individual IT equipment items (the devices themselves).
 * It includes foreign keys to link to the Asset Model (specs) and the User (assignment).
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            // Core Identification Fields
            $table->string('asset_tag')->unique()->nullable()->comment('Barcode or unique identifier');
            $table->string('serial')->unique()->nullable();
            
            // Relationships (Foreign Keys)
            // Links this device to the Asset Model (specs defined in asset_models table)
            // onDelete('set null') means if an Asset Model is deleted, the asset's model_id is set to null.
            $table->foreignId('model_id')->nullable()->constrained('asset_models')->onDelete('set null');
            
            // Links this device to the assigned User
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->comment('Assigned user ID');
            
            // Status and Checkout Details
            $table->string('status')->default('Available')->comment('e.g., Available, Assigned, Maintenance');
            $table->timestamp('checked_out_at')->nullable()->comment('Date and time asset was checked out');
            
            // Financial/Logistics Data (Optional but useful)
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 8, 2)->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};