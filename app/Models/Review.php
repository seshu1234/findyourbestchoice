<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'tool_id',
        'user_id',
        'rating',
        'title',
        'content',
        'pros',
        'cons',
        'approved',
    ];

    protected $casts = [
        'pros' => 'array',
        'cons' => 'array',
        'approved' => 'boolean',
    ];

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
