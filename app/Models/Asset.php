<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Note: 'asset_tag' is unique identifier.
     */
    protected $fillable = [
        'asset_tag',
        'serial',
        'model_id',
        'user_id',
        'checked_out_at',
        'notes',
        'status',
        'location_id',
    ];
    
    // Define the relationship: An Asset belongs to a User (when checked out).
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // In a real application, you would also define relationships for
    // Model, Status, Location, etc.
}
