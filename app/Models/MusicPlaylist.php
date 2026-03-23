<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MusicPlaylist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_url',
        'created_by_user_id',
    ];

    public function tracks(): HasMany
    {
        return $this->hasMany(MusicTrack::class)->orderBy('position')->orderBy('id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
