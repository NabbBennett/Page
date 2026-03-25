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

        if ($textContent === '' && $htmlContent === '') {
            return response()->json(['message' => 'El escrito no puede estar vacío.'], 422);
        }

        $password = isset($validated['password']) ? trim((string) $validated['password']) : '';
        $writing = FileWriting::query()->create([
            'user_type' => (string) session('user_type', 'guest'),
            'user_id' => session('user_id'),
            'title' => trim((string) $validated['title']),
            'text_content' => $textContent !== '' ? $textContent : null,
            'html_content' => $htmlContent !== '' ? $htmlContent : null,
        ]);

        $folderId = isset($validated['folder_id']) ? (int) $validated['folder_id'] : null;
        $imagePath = trim((string) ($validated['image_path'] ?? ''));

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
                'html_content' => $writing->html_content,
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
