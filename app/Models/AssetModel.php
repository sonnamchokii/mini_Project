<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Add this

class AssetModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'manufacturer',
        'depreciation_period',
        'is_requestable',
        'description', // Add description here if you want to mass-assign it.
        'category',    // Assuming you might add a category later
    ];

    /**
     * An AssetModel can have many individual Assets linked to it.
     */
    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'model_id');
    }

    /**
     * Get the count of available assets for this model.
     */
    public function getAvailableCountAttribute(): int
    {
        // Count assets linked to this model that are currently 'Available'
        return $this->assets()->where('status', 'Available')->count();
    }

    /**
     * Get the total count of assets for this model.
     */
    public function getTotalAssetsAttribute(): int
    {
        return $this->assets()->count();
    }
}