<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tool extends Model
{
    protected $fillable = [
        'name','slug','short_description','description','category_id',
        'logo_url','images','price_from','affiliate_url','official_url',
        'pros','cons','meta','upvotes','created_by'
    ];

    protected $casts = [
        'images' => 'array',
        'pros' => 'array',
        'cons' => 'array',
        'meta' => 'array',
        'price_from' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function affiliateClicks(): HasMany
    {
        return $this->hasMany(AffiliateClick::class);
    }

    public function sponsoredListings(): HasMany
    {
        return $this->hasMany(SponsoredListing::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
