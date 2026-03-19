<?php

use App\Models\SocialPost;
use App\Models\SocialComment;
use App\Models\SocialUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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
