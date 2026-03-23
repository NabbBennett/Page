<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('music_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('music_playlist_id')->constrained('music_playlists')->cascadeOnDelete();
            $table->string('title');
            $table->string('artist')->nullable();
            $table->longText('youtube_url');
            $table->string('youtube_video_id', 20);
            $table->longText('thumbnail_url')->nullable();
            $table->longText('embed_url');
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->index(['music_playlist_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('music_tracks');
    }
};
