<?php

namespace App\Http\Controllers;

use App\Models\FileFolder;
use App\Models\FileWriting;
use App\Models\FileWritingAssignment;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        return view('archivos', [
            'userType' => session('user_type', 'guest'),
        ]);
    }

    public function writings()
    {
        $query = FileWriting::query()
            ->where('user_type', 'admin')
            ->where('is_draft', false)
            ->orderByDesc('id');

        $writings = $query->get()->map(function (FileWriting $writing) {
            $assignment = FileWritingAssignment::query()
                ->where('file_writing_id', $writing->id)
                ->latest('id')
                ->first();

            return [
                'id' => $writing->id,
                'title' => $writing->title,
                'text_content' => $writing->text_content,
                'html_content' => $writing->html_content,
                'folder_id' => $assignment?->file_folder_id,
                'image_path' => $assignment?->image_path,
                'is_encrypted' => (bool) ($assignment?->is_encrypted ?? false),
                'password' => $assignment?->password,
                'created_at' => $writing->created_at?->toISOString(),
                'updated_at' => $writing->updated_at?->toISOString(),
            ];
        })->values();

        return response()->json(['writings' => $writings]);
    }

    public function drafts()
    {
        $query = FileWriting::query()
            ->where('user_type', 'admin')
            ->where('is_draft', true)
            ->orderByDesc('updated_at')
            ->orderByDesc('id');

        $drafts = $query->get()->map(fn (FileWriting $draft) => [
            'id' => $draft->id,
            'title' => $draft->title,
            'text_content' => $draft->text_content,
            'html_content' => $draft->html_content,
            'created_at' => $draft->created_at?->toISOString(),
            'updated_at' => $draft->updated_at?->toISOString(),
        ])->values();

        return response()->json(['drafts' => $drafts]);
    }

    public function storeDraft(Request $request)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'draft_id' => ['nullable', 'integer', 'exists:file_writings,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'text_content' => ['nullable', 'string'],
            'html_content' => ['nullable', 'string'],
        ]);

        $textContent = trim((string) ($validated['text_content'] ?? ''));
        $htmlContent = trim((string) ($validated['html_content'] ?? ''));

        if ($textContent === '' && $htmlContent === '') {
            return response()->json(['message' => 'El borrador no puede estar vacío.'], 422);
        }

        $title = trim((string) ($validated['title'] ?? ''));
        if ($title === '') {
            $title = mb_substr($textContent, 0, 52) ?: 'Borrador sin título';
        }

        $draft = null;
        if (!empty($validated['draft_id'])) {
            $draft = FileWriting::query()
                ->where('id', (int) $validated['draft_id'])
                ->where('user_type', 'admin')
                ->where('is_draft', true)
                ->first();
        }

        if ($draft) {
            $draft->update([
                'title' => $title,
                'text_content' => $textContent,
                'html_content' => $htmlContent,
            ]);
        } else {
            $draft = FileWriting::query()->create([
                'user_type' => (string) session('user_type', 'guest'),
                'user_id' => session('user_id'),
                'title' => $title,
                'text_content' => $textContent,
                'html_content' => $htmlContent,
                'is_draft' => true,
            ]);
        }

        return response()->json([
            'message' => 'Borrador guardado correctamente.',
            'draft' => [
                'id' => $draft->id,
                'title' => $draft->title,
                'text_content' => $draft->text_content,
                'html_content' => $draft->html_content,
                'created_at' => $draft->created_at?->toISOString(),
                'updated_at' => $draft->updated_at?->toISOString(),
            ],
        ]);
    }

    public function deleteDraft(FileWriting $writing)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        if (!(bool) $writing->is_draft) {
            return response()->json(['message' => 'El registro indicado no es un borrador.'], 422);
        }

        $writing->delete();

        return response()->json(['message' => 'Borrador eliminado correctamente.']);
    }

    public function storeWriting(Request $request)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'folder_id' => ['nullable', 'integer', 'exists:file_folders,id'],
            'image_path' => ['nullable', 'string'],
            'text_content' => ['nullable', 'string'],
            'html_content' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'max:255'],
        ]);

        $textContent = trim((string) ($validated['text_content'] ?? ''));
        $htmlContent = trim((string) ($validated['html_content'] ?? ''));
        $imagePath = trim((string) ($validated['image_path'] ?? ''));
        if ($textContent === '' && $htmlContent === '' && $imagePath === '') {
            return response()->json(['message' => 'El escrito no puede estar vacío.'], 422);
        }

        $password = isset($validated['password']) ? trim((string) $validated['password']) : '';
        $writing = FileWriting::query()->create([
            'user_type' => (string) session('user_type', 'guest'),
            'user_id' => session('user_id'),
            'title' => trim((string) $validated['title']),
            'text_content' => $textContent !== '' ? $textContent : null,
            'html_content' => $htmlContent !== '' ? $htmlContent : null,
            'is_draft' => false,
        ]);

        $folderId = isset($validated['folder_id']) ? (int) $validated['folder_id'] : null;

        if ($folderId || $imagePath !== '' || $password !== '') {
            FileWritingAssignment::query()->create([
                'file_writing_id' => $writing->id,
                'file_folder_id' => $folderId ?: null,
                'image_path' => $imagePath !== '' ? $imagePath : null,
                'is_encrypted' => $password !== '',
                'password' => $password !== '' ? $password : null,
                'assigned_by_user_id' => session('user_id'),
            ]);
        }

        return response()->json([
            'message' => 'Escrito guardado correctamente.',
            'writing' => [
                'id' => $writing->id,
                'folder_id' => $folderId,
                'title' => $writing->title,
                'text_content' => $writing->text_content,
                'image_path' => $imagePath !== '' ? $imagePath : null,
                'is_encrypted' => $password !== '',
                'password' => $password !== '' ? $password : null,
                'created_at' => $writing->created_at?->toISOString(),
                'updated_at' => $writing->updated_at?->toISOString(),
            ],
        ], 201);
    }

    public function deleteWriting(FileWriting $writing)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $writing->delete();

        return response()->json(['message' => 'Escrito eliminado correctamente.']);
    }

    public function folders()
    {
        $query = FileFolder::query()
            ->where('user_type', 'admin')
            ->orderBy('name');

        return response()->json([
            'folders' => $query->get()->map(fn (FileFolder $folder) => [
                'id' => $folder->id,
                'name' => $folder->name,
            ])->values(),
        ]);
    }

    public function storeFolder(Request $request)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $folder = FileFolder::query()->create([
            'user_type' => (string) session('user_type', 'guest'),
            'user_id' => session('user_id'),
            'name' => trim((string) $validated['name']),
        ]);

        return response()->json([
            'message' => 'Carpeta creada correctamente.',
            'folder' => [
                'id' => $folder->id,
                'name' => $folder->name,
            ],
        ], 201);
    }

    public function updateFolder(Request $request, FileFolder $folder)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $folder->update([
            'name' => trim((string) $validated['name']),
        ]);

        return response()->json([
            'message' => 'Carpeta actualizada correctamente.',
            'folder' => [
                'id' => $folder->id,
                'name' => $folder->name,
            ],
        ]);
    }

    public function deleteFolder(FileFolder $folder)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $writingIds = FileWritingAssignment::query()
            ->where('file_folder_id', $folder->id)
            ->pluck('file_writing_id')
            ->unique()
            ->values();

        if ($writingIds->isNotEmpty()) {
            FileWriting::query()->whereIn('id', $writingIds)->delete();
        }

        $folder->delete();

        return response()->json(['message' => 'Carpeta eliminada correctamente.']);
    }

    private function ensureAdmin()
    {
        if ((string) session('user_type', 'guest') !== 'admin') {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return null;
    }
}
