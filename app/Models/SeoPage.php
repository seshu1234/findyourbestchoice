<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'tools',
        'meta',
        'created_by',
    ];

    protected $casts = [
        'tools' => 'array',
        'meta' => 'array',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
