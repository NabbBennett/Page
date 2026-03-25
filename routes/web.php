<?php

use App\Models\SocialPost;
use App\Models\SocialComment;
use App\Models\SocialUser;
use App\Models\MusicPlaylist;
use App\Models\MusicTrack;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    if (session('user_logged_in')) {
        return redirect('/dashboard');
    }

    return view('login');
})->name('login');

Route::post('/login', function () {
    if (session('user_logged_in')) {
        return redirect('/dashboard');
    }

    $username = trim((string) request('username', ''));
    $password = (string) request('password', '');

    $admin = User::query()
        ->where('name', 'Nabb')
        ->first();

    if ($admin && hash_equals('Nabb', $username) && Hash::check($password, $admin->password)) {
        request()->session()->regenerate();
        session([
            'user_type' => 'admin',
            'user_logged_in' => true,
            'user_name' => $admin->name,
            'user_id' => $admin->id,
        ]);

        return redirect('/dashboard');
    }

    return back()->withErrors(['credentials' => 'Las credenciales no son válidas']);
})->name('admin.login');

Route::get('/guest', function () {
    request()->session()->regenerate();
    session([
        'user_type' => 'guest',
        'user_logged_in' => true,
        'user_name' => 'Visitante',
        'user_id' => null,
    ]);

    return redirect('/dashboard');
})->name('guest');

Route::middleware('session.auth')->group(function () {
Route::get('/dashboard', function () {
    $userType = session('user_type');
    $userName = session('user_name', 'Usuario');

    return view('dashboard', [
        'userType' => $userType,
        'userName' => $userName
    ]);
})->name('dashboard');

Route::get('/logout', function () {
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/text-editor', function () {
    return view('textEditor');
})->name('text-editor');

Route::get('/red-social', function () {
    return view('redSocial', [
        'userType' => session('user_type', 'guest'),
    ]);
})->name('red-social');

Route::get('/biblioteca', function () {
    return view('biblioteca', [
        'userType' => session('user_type', 'guest'),
    ]);
})->name('biblioteca');

Route::get('/archivos', function () {
    return view('archivos', [
        'userType' => session('user_type', 'guest'),
    ]);
})->name('archivos');

Route::get('/music/playlists', function () {
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
                'cover_url' => (function () use ($playlist) {
                    $coverUrl = (string) $playlist->cover_url;

                    if (Str::startsWith($coverUrl, ['/storage/', 'storage/'])) {
                        return asset(ltrim($coverUrl, '/'));
                    }

                    if (Str::startsWith($coverUrl, ['storage\\app\\public\\', 'storage/app/public/'])) {
                        $relativeFile = Str::after($coverUrl, Str::startsWith($coverUrl, 'storage\\app\\public\\')
                            ? 'storage\\app\\public\\'
                            : 'storage/app/public/');

                        return asset('storage/'.str_replace('\\', '/', $relativeFile));
                    }

                    return $playlist->cover_url;
                })(),
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
});

Route::post('/music/upload-cover', function (Request $request) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
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
});

Route::post('/music/playlists', function (Request $request) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
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
});

Route::put('/music/playlists/{playlist}', function (Request $request, MusicPlaylist $playlist) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
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
});

Route::delete('/music/playlists/{playlist}', function (MusicPlaylist $playlist) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $playlist->delete();

    return response()->json(['message' => 'Playlist eliminada correctamente.']);
});

Route::post('/music/tracks', function (Request $request) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
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
});

Route::delete('/music/tracks/{track}', function (MusicTrack $track) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    foreach ([$track->audio_url, $track->thumbnail_url] as $url) {
        $path = trim((string) parse_url((string) $url, PHP_URL_PATH), '/');
        if (Str::startsWith($path, 'storage/')) {
            Storage::disk('public')->delete(Str::after($path, 'storage/'));
        }
    }

    $track->delete();

    return response()->json(['message' => 'Canción eliminada correctamente.']);
});

Route::post('/social/posts', function (Request $request) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $validated = $request->validate([
        'text' => ['nullable', 'string'],
        'image' => ['nullable', 'string'],
        'character' => ['required', 'array'],
        'character.db_id' => ['nullable', 'integer'],
        'character.name' => ['required', 'string', 'max:255'],
        'character.username' => ['required', 'string', 'max:255'],
        'character.bio' => ['nullable', 'string'],
        'character.avatar' => ['nullable', 'string'],
        'character.banner' => ['nullable', 'string'],
    ]);

    $text = trim((string) ($validated['text'] ?? ''));
    $image = trim((string) ($validated['image'] ?? ''));

    if ($text === '' && $image === '') {
        return response()->json(['message' => 'El post debe incluir texto, imagen o ambos.'], 422);
    }

    $character = $validated['character'];
    $normalizedUsername = trim((string) $character['username']);
    if ($normalizedUsername !== '' && !str_starts_with($normalizedUsername, '@')) {
        $normalizedUsername = '@'.$normalizedUsername;
    }

    $dbId = (int) ($character['db_id'] ?? 0);
    if ($dbId > 0) {
        $socialUser = SocialUser::query()->find($dbId);
        if (!$socialUser) {
            return response()->json(['message' => 'El perfil seleccionado no existe en la base de datos.'], 404);
        }

        $socialUser->update([
            'name' => $character['name'],
            'username' => $normalizedUsername,
            'bio' => $character['bio'] ?? null,
            'icon_path' => $character['avatar'] ?? null,
            'banner_path' => $character['banner'] ?? null,
        ]);
    } else {
        $socialUser = SocialUser::query()->updateOrCreate(
            ['username' => $normalizedUsername],
            [
                'name' => $character['name'],
                'bio' => $character['bio'] ?? null,
                'icon_path' => $character['avatar'] ?? null,
                'banner_path' => $character['banner'] ?? null,
            ]
        );
    }

    $post = SocialPost::query()->create([
        'social_user_id' => $socialUser->id,
        'text' => $text !== '' ? $text : null,
        'image_path' => $image !== '' ? $image : null,
        'likes_count' => 0,
    ]);

    return response()->json([
        'message' => 'Post guardado correctamente.',
        'post' => [
            'id' => $post->id,
            'social_user_id' => $post->social_user_id,
        ],
    ], 201);
});

Route::delete('/social/posts/{post}', function (SocialPost $post) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $post->delete();

    return response()->json(['message' => 'Post eliminado correctamente.']);
});

Route::post('/social/posts/{post}/comments', function (Request $request, SocialPost $post) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $validated = $request->validate([
        'comment' => ['nullable', 'string'],
        'image' => ['nullable', 'string'],
        'character' => ['required', 'array'],
        'character.db_id' => ['nullable', 'integer'],
        'character.name' => ['required', 'string', 'max:255'],
        'character.username' => ['required', 'string', 'max:255'],
        'character.bio' => ['nullable', 'string'],
        'character.avatar' => ['nullable', 'string'],
        'character.banner' => ['nullable', 'string'],
    ]);

    $commentText = trim((string) ($validated['comment'] ?? ''));
    $image = trim((string) ($validated['image'] ?? ''));

    if ($commentText === '' && $image === '') {
        return response()->json(['message' => 'El comentario debe incluir texto, imagen o ambos.'], 422);
    }

    $character = $validated['character'];
    $normalizedUsername = trim((string) $character['username']);
    if ($normalizedUsername !== '' && !str_starts_with($normalizedUsername, '@')) {
        $normalizedUsername = '@'.$normalizedUsername;
    }

    $dbId = (int) ($character['db_id'] ?? 0);
    if ($dbId > 0) {
        $socialUser = SocialUser::query()->find($dbId);
        if (!$socialUser) {
            return response()->json(['message' => 'El perfil seleccionado no existe en la base de datos.'], 404);
        }

        $socialUser->update([
            'name' => $character['name'],
            'username' => $normalizedUsername,
            'bio' => $character['bio'] ?? null,
            'icon_path' => $character['avatar'] ?? null,
            'banner_path' => $character['banner'] ?? null,
        ]);
    } else {
        $socialUser = SocialUser::query()->updateOrCreate(
            ['username' => $normalizedUsername],
            [
                'name' => $character['name'],
                'bio' => $character['bio'] ?? null,
                'icon_path' => $character['avatar'] ?? null,
                'banner_path' => $character['banner'] ?? null,
            ]
        );
    }

    $comment = SocialComment::query()->create([
        'social_post_id' => $post->id,
        'social_user_id' => $socialUser->id,
        'comment' => $commentText !== '' ? $commentText : null,
        'image_path' => $image !== '' ? $image : null,
    ]);

    return response()->json([
        'message' => 'Comentario guardado correctamente.',
        'comment' => [
            'id' => $comment->id,
            'social_post_id' => $comment->social_post_id,
            'social_user_id' => $comment->social_user_id,
        ],
    ], 201);
});

Route::delete('/social/comments/{comment}', function (SocialComment $comment) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $comment->delete();

    return response()->json(['message' => 'Comentario eliminado correctamente.']);
});

Route::post('/social/profiles', function (Request $request) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255'],
        'bio' => ['required', 'string'],
        'avatar' => ['required', 'string'],
        'banner' => ['required', 'string'],
    ]);

    $normalizedUsername = trim((string) $validated['username']);
    if ($normalizedUsername !== '' && !str_starts_with($normalizedUsername, '@')) {
        $normalizedUsername = '@'.$normalizedUsername;
    }

    if (SocialUser::query()->where('username', $normalizedUsername)->exists()) {
        return response()->json(['message' => 'Ya existe un perfil con ese usuario.'], 422);
    }

    $profile = SocialUser::query()->create([
        'name' => $validated['name'],
        'username' => $normalizedUsername,
        'bio' => $validated['bio'],
        'icon_path' => $validated['avatar'],
        'banner_path' => $validated['banner'],
    ]);

    return response()->json([
        'message' => 'Perfil creado correctamente.',
        'profile' => [
            'id' => $profile->id,
            'name' => $profile->name,
            'username' => $profile->username,
            'bio' => $profile->bio,
            'avatar' => $profile->icon_path,
            'banner' => $profile->banner_path,
        ],
    ], 201);
});

Route::put('/social/profiles/{profile}', function (Request $request, SocialUser $profile) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255'],
        'bio' => ['required', 'string'],
        'avatar' => ['nullable', 'string'],
        'banner' => ['nullable', 'string'],
    ]);

    $normalizedUsername = trim((string) $validated['username']);
    if ($normalizedUsername !== '' && !str_starts_with($normalizedUsername, '@')) {
        $normalizedUsername = '@'.$normalizedUsername;
    }

    $exists = SocialUser::query()
        ->where('username', $normalizedUsername)
        ->where('id', '!=', $profile->id)
        ->exists();

    if ($exists) {
        return response()->json(['message' => 'Ya existe otro perfil con ese usuario.'], 422);
    }

    $profile->update([
        'name' => $validated['name'],
        'username' => $normalizedUsername,
        'bio' => $validated['bio'],
        'icon_path' => $validated['avatar'] ?? $profile->icon_path,
        'banner_path' => $validated['banner'] ?? $profile->banner_path,
    ]);

    return response()->json(['message' => 'Perfil actualizado correctamente.']);
});

Route::delete('/social/profiles/{profile}', function (SocialUser $profile) {
    if (session('user_type') !== 'admin') {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $profile->delete();

    return response()->json(['message' => 'Perfil eliminado correctamente.']);
});
});
