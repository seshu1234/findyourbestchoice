<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comparison extends Model
{
    protected $fillable = [
        'tool_a_id',
        'tool_b_id',
        'slug',
        'comparison_data',
        'content',
        'meta',
        'created_by',
    ];

    protected $casts = [
        'comparison_data' => 'array',
        'meta' => 'array',
    ];

    public function toolA(): BelongsTo
    {
        return $this->belongsTo(Tool::class, 'tool_a_id');
    }

    public function toolB(): BelongsTo
    {
        return $this->belongsTo(Tool::class, 'tool_b_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
