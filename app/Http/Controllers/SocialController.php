<?php

namespace App\Http\Controllers;

use App\Models\SocialComment;
use App\Models\SocialPost;
use App\Models\SocialUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function data(): JsonResponse
    {
        $profiles = SocialUser::query()
            ->orderBy('name')
            ->get()
            ->map(function (SocialUser $user) {
                return [
                    'id' => 'char-db-'.$user->id,
                    'db_id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'bio' => $user->bio,
                    'avatar' => $user->icon_path,
                    'banner' => $user->banner_path,
                    'followers' => 0,
                    'following' => 0,
                    'joined' => $user->created_at?->format('F Y') ?? '-',
                ];
            })
            ->values();

        $posts = SocialPost::query()
            ->with(['comments.author', 'author'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function (SocialPost $post) {
                $commentsList = $post->comments
                    ->sortBy('created_at')
                    ->values()
                    ->map(function (SocialComment $comment) {
                        return [
                            'id' => 'comment-db-'.$comment->id,
                            'db_id' => $comment->id,
                            'character_id' => 'char-db-'.$comment->social_user_id,
                            'text' => $comment->comment ?? '',
                            'image' => $comment->image_path,
                            'created_at' => $comment->created_at?->getTimestampMs() ?? now()->getTimestampMs(),
                        ];
                    })
                    ->values();

                return [
                    'id' => 'post-db-'.$post->id,
                    'db_id' => $post->id,
                    'character_id' => 'char-db-'.$post->social_user_id,
                    'text' => $post->text ?? '',
                    'image' => $post->image_path,
                    'created_at' => $post->created_at?->getTimestampMs() ?? now()->getTimestampMs(),
                    'likes' => (int) $post->likes_count,
                    'comments_list' => $commentsList,
                ];
            })
            ->values();

        return response()->json([
            'profiles' => $profiles,
            'posts' => $posts,
        ]);
    }

    public function storePost(Request $request): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
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

        $socialUser = $this->upsertSocialUserFromCharacterPayload($validated['character']);

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
    }

    public function deletePost(SocialPost $post): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $post->delete();

        return response()->json(['message' => 'Post eliminado correctamente.']);
    }

    public function storeComment(Request $request, SocialPost $post): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
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

        $socialUser = $this->upsertSocialUserFromCharacterPayload($validated['character']);

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
    }

    public function deleteComment(SocialComment $comment): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $comment->delete();

        return response()->json(['message' => 'Comentario eliminado correctamente.']);
    }

    public function storeProfile(Request $request): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
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
    }

    public function updateProfile(Request $request, SocialUser $profile): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
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
    }

    public function deleteProfile(SocialUser $profile): JsonResponse
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $profile->delete();

        return response()->json(['message' => 'Perfil eliminado correctamente.']);
    }

    private function ensureAdmin(): ?JsonResponse
    {
        if (session('user_type') !== 'admin') {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return null;
    }

    private function upsertSocialUserFromCharacterPayload(array $character): SocialUser
    {
        $normalizedUsername = trim((string) ($character['username'] ?? ''));
        if ($normalizedUsername !== '' && !str_starts_with($normalizedUsername, '@')) {
            $normalizedUsername = '@'.$normalizedUsername;
        }

        $dbId = (int) ($character['db_id'] ?? 0);
        if ($dbId > 0) {
            $socialUser = SocialUser::query()->find($dbId);
            if (!$socialUser) {
                abort(response()->json(['message' => 'El perfil seleccionado no existe en la base de datos.'], 404));
            }

            $socialUser->update([
                'name' => $character['name'],
                'username' => $normalizedUsername,
                'bio' => $character['bio'] ?? null,
                'icon_path' => $character['avatar'] ?? null,
                'banner_path' => $character['banner'] ?? null,
            ]);

            return $socialUser;
        }

        return SocialUser::query()->updateOrCreate(
            ['username' => $normalizedUsername],
            [
                'name' => $character['name'],
                'bio' => $character['bio'] ?? null,
                'icon_path' => $character['avatar'] ?? null,
                'banner_path' => $character['banner'] ?? null,
            ]
        );
    }
}
