<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MusicTrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_playlist_id',
        'title',
        'artist',
        'album',
        'audio_url',
        'youtube_url',
        'youtube_video_id',
        'thumbnail_url',
        'embed_url',
        'duration_seconds',
        'position',
    ];

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(MusicPlaylist::class, 'music_playlist_id');
    }
}
