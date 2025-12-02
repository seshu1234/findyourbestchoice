<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'username',
        'avatar',
        'password',
        'verification_code',
        'verified',
        'trial_ends_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'verified' => 'boolean',
        'trial_ends_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Auto-generate username if empty
        static::creating(function ($user) {
            if (empty($user->username)) {
                $username = Str::slug($user->name ?: explode('@',$user->email)[0], '');
                $i = 1;
                while (self::where('username', $username)->exists()) {
                    $username = $username . $i;
                    $i++;
                }
                $user->username = $username;
            }
        });

        // Assign default role
        static::created(function ($user) {
            if (!$user->hasRole('registered')) {
                $user->assignRole('registered');
            }
        });
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class, 'created_by');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
