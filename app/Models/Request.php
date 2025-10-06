<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset_model_id',
        'needed_by_date',
        'justification',
        'status', // e.g., 'Pending', 'Approved', 'Denied', 'Fulfilled'
        'admin_notes',
    ];

    protected $casts = [
        'needed_by_date' => 'date',
    ];

    /**
     * A request belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A request is for a specific asset model.
     */
    public function assetModel(): BelongsTo
    {
        return $this->belongsTo(AssetModel::class);
    }
}
