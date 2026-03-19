<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'bio',
        'icon_path',
        'banner_path',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(SocialPost::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(SocialComment::class);
    }
}
