<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_post_id',
        'social_user_id',
        'comment',
        'image_path',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(SocialPost::class, 'social_post_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(SocialUser::class, 'social_user_id');
    }
}
