<?php

namespace App\Http\Controllers;

use App\Models\MusicPlaylist;
use App\Models\MusicTrack;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MusicController extends Controller
{
    public function playlists(): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $playlists = MusicPlaylist::query()
            ->with(['tracks' => function ($query) {
                $query->orderBy('position')->orderBy('id');
            }])
            ->orderBy('name')
            ->get();

        return response()->json([
            'playlists' => $playlists->map(function (MusicPlaylist $playlist) {
                return [
                    'id' => $playlist->id,
                    'name' => $playlist->name,
                    'description' => $playlist->description,
                    'cover_url' => $this->resolveCoverUrl($playlist->cover_url),
                    'tracks' => $playlist->tracks->map(function (MusicTrack $track) {
                        return [
                            'id' => $track->id,
                            'title' => $track->title,
                            'artist' => $track->artist,
                            'album' => $track->album,
                            'audio_url' => Str::startsWith((string) $track->audio_url, ['/storage/', 'storage/'])
                                ? asset(ltrim((string) $track->audio_url, '/'))
                                : $track->audio_url,
                            'youtube_url' => $track->youtube_url,
                            'youtube_video_id' => $track->youtube_video_id,
                            'thumbnail_url' => Str::startsWith((string) $track->thumbnail_url, ['/storage/', 'storage/'])
                                ? asset(ltrim((string) $track->thumbnail_url, '/'))
                                : $track->thumbnail_url,
                            'embed_url' => $track->embed_url,
                            'duration_seconds' => $track->duration_seconds,
                            'position' => $track->position,
                        ];
                    })->values(),
                ];
            })->values(),
        ]);
    }

    public function uploadCover(Request $request): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'cover' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        $path = $validated['cover']->store('music-covers', 'public');
        $dbPath = 'storage\\app\\public\\'.str_replace('/', '\\', $path);

        return response()->json([
            'message' => 'Portada subida correctamente.',
            'cover_url' => $dbPath,
            'cover_path' => $path,
            'cover_public_url' => asset('storage/'.$path),
        ], 201);
    }

    public function storePlaylist(Request $request): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:4000'],
            'cover_url' => ['nullable', 'string', 'max:10000'],
        ]);

        $playlist = MusicPlaylist::query()->create([
            'name' => trim($validated['name']),
            'description' => trim((string) ($validated['description'] ?? '')) ?: null,
            'cover_url' => trim((string) ($validated['cover_url'] ?? '')) ?: null,
            'created_by_user_id' => session('user_id'),
        ]);

        return response()->json([
            'message' => 'Playlist creada correctamente.',
            'playlist' => [
                'id' => $playlist->id,
                'name' => $playlist->name,
                'description' => $playlist->description,
                'cover_url' => $playlist->cover_url,
                'tracks' => [],
            ],
        ], 201);
    }

    public function updatePlaylist(Request $request, MusicPlaylist $playlist): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:4000'],
            'cover_url' => ['nullable', 'string', 'max:10000'],
        ]);

        $playlist->update([
            'name' => trim($validated['name']),
            'description' => trim((string) ($validated['description'] ?? '')) ?: null,
            'cover_url' => trim((string) ($validated['cover_url'] ?? '')) ?: null,
        ]);

        return response()->json(['message' => 'Playlist actualizada correctamente.']);
    }

    public function deletePlaylist(MusicPlaylist $playlist): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $playlist->delete();

        return response()->json(['message' => 'Playlist eliminada correctamente.']);
    }

    public function storeTrack(Request $request): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'music_playlist_id' => ['required', 'integer', 'exists:music_playlists,id'],
            'title' => ['required', 'string', 'max:255'],
            'artist' => ['required', 'string', 'max:255'],
            'album' => ['required', 'string', 'max:255'],
            'audio' => ['required', 'file', 'mimes:mp3', 'max:25600'],
            'cover' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        $playlistId = (int) $validated['music_playlist_id'];
        $lastPosition = (int) (MusicTrack::query()
            ->where('music_playlist_id', $playlistId)
            ->max('position') ?? 0);

        $audioPath = $validated['audio']->store('music-tracks', 'public');
        $coverPath = $validated['cover']->store('music-covers', 'public');

        $track = MusicTrack::query()->create([
            'music_playlist_id' => $playlistId,
            'title' => trim((string) $validated['title']),
            'artist' => trim((string) $validated['artist']),
            'album' => trim((string) $validated['album']),
            'audio_url' => asset('storage/'.$audioPath),
            'youtube_url' => '',
            'youtube_video_id' => '',
            'thumbnail_url' => asset('storage/'.$coverPath),
            'embed_url' => '',
            'duration_seconds' => null,
            'position' => $lastPosition + 1,
        ]);

        return response()->json([
            'message' => 'Canción agregada correctamente.',
            'track' => [
                'id' => $track->id,
                'music_playlist_id' => $track->music_playlist_id,
                'title' => $track->title,
                'artist' => $track->artist,
                'album' => $track->album,
                'audio_url' => $track->audio_url,
                'youtube_url' => $track->youtube_url,
                'youtube_video_id' => $track->youtube_video_id,
                'thumbnail_url' => $track->thumbnail_url,
                'embed_url' => $track->embed_url,
                'duration_seconds' => $track->duration_seconds,
                'position' => $track->position,
            ],
        ], 201);
    }

    public function deleteTrack(MusicTrack $track): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        foreach ([$track->audio_url, $track->thumbnail_url] as $url) {
            $path = trim((string) parse_url((string) $url, PHP_URL_PATH), '/');
            if (Str::startsWith($path, 'storage/')) {
                Storage::disk('public')->delete(Str::after($path, 'storage/'));
            }
        }

        $track->delete();

        return response()->json(['message' => 'Canción eliminada correctamente.']);
    }

    private function ensureAdmin(): ?JsonResponse
    {
        if (session('user_type') !== 'admin') {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return null;
    }

    private function resolveCoverUrl(?string $coverUrl): ?string
    {
        $value = (string) $coverUrl;

        if (Str::startsWith($value, ['/storage/', 'storage/'])) {
            return asset(ltrim($value, '/'));
        }

        if (Str::startsWith($value, ['storage\\app\\public\\', 'storage/app/public/'])) {
            $relativeFile = Str::after($value, Str::startsWith($value, 'storage\\app\\public\\')
                ? 'storage\\app\\public\\'
                : 'storage/app/public/');

            return asset('storage/'.str_replace('\\', '/', $relativeFile));
        }

        return $coverUrl;
    }
}
