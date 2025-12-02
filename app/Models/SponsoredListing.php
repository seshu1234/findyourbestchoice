<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SponsoredListing extends Model
{
    protected $fillable = [
        'tool_id',
        'created_by',
        'amount',
        'starts_at',
        'ends_at',
        'placement',
        'slot_name',
        'priority',
        'active',
        'meta',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'active' => 'boolean',
        'meta' => 'array',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
