<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_user_id',
        'text',
        'image_path',
        'likes_count',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(SocialUser::class, 'social_user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(SocialComment::class);
    }
}
