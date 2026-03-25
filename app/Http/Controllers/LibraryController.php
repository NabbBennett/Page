<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;
use App\Models\LibraryBookAssignment;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        return view('biblioteca', [
            'userType' => session('user_type', 'guest'),
        ]);
    }

    public function books()
    {
        $query = LibraryBook::query()
            ->where('user_type', 'admin')
            ->orderByDesc('id');

        $books = $query->get()->map(function (LibraryBook $book) {
            $chapters = LibraryBookAssignment::query()
                ->where('library_book_id', $book->id)
                ->orderBy('chapter_number')
                ->orderBy('id')
                ->get()
                ->map(fn (LibraryBookAssignment $chapter) => [
                    'id' => $chapter->id,
                    'chapter_number' => $chapter->chapter_number,
                    'chapter_title' => $chapter->chapter_title,
                    'text_content' => $chapter->text_content,
                    'html_content' => $chapter->html_content,
                ])->values();

            return [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'description' => $book->description,
                'status' => $book->status,
                'cover_path' => $book->cover_path,
                'chapters' => $chapters,
                'created_at' => $book->created_at?->toISOString(),
                'updated_at' => $book->updated_at?->toISOString(),
            ];
        })->values();

        return response()->json(['books' => $books]);
    }

    public function storeBook(Request $request)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:60'],
            'cover_path' => ['nullable', 'string'],
        ]);

        $book = LibraryBook::query()->create([
            'user_type' => (string) session('user_type', 'guest'),
            'user_id' => session('user_id'),
            'title' => trim((string) $validated['title']),
            'author' => trim((string) $validated['author']),
            'description' => trim((string) ($validated['description'] ?? '')) ?: null,
            'status' => trim((string) ($validated['status'] ?? 'En emisión')) ?: 'En emisión',
            'cover_path' => trim((string) ($validated['cover_path'] ?? '')) ?: null,
        ]);

        return response()->json([
            'message' => 'Libro guardado correctamente.',
            'book' => [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'description' => $book->description,
                'status' => $book->status,
                'cover_path' => $book->cover_path,
            ],
        ], 201);
    }

    public function updateBook(Request $request, LibraryBook $book)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:60'],
            'cover_path' => ['nullable', 'string'],
        ]);

        $book->update([
            'title' => trim((string) $validated['title']),
            'author' => trim((string) $validated['author']),
            'description' => trim((string) ($validated['description'] ?? '')) ?: null,
            'status' => trim((string) ($validated['status'] ?? 'En emisión')) ?: 'En emisión',
            'cover_path' => trim((string) ($validated['cover_path'] ?? '')) ?: null,
        ]);

        return response()->json([
            'message' => 'Libro actualizado correctamente.',
            'book' => [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'description' => $book->description,
                'status' => $book->status,
                'cover_path' => $book->cover_path,
            ],
        ]);
    }

    public function deleteBook(LibraryBook $book)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $book->delete();

        return response()->json(['message' => 'Libro eliminado correctamente.']);
    }

    public function storeAssignment(Request $request, LibraryBook $book)
    {
        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $validated = $request->validate([
            'chapter_number' => ['nullable', 'integer', 'min:1'],
            'chapter_title' => ['nullable', 'string', 'max:255'],
            'text_content' => ['nullable', 'string'],
            'html_content' => ['nullable', 'string'],
        ]);

        $chapter = LibraryBookAssignment::query()->create([
            'library_book_id' => $book->id,
            'chapter_number' => (int) ($validated['chapter_number'] ?? 1),
            'chapter_title' => trim((string) ($validated['chapter_title'] ?? '')) ?: null,
            'text_content' => trim((string) ($validated['text_content'] ?? '')) ?: null,
            'html_content' => trim((string) ($validated['html_content'] ?? '')) ?: null,
            'assigned_by_user_id' => session('user_id'),
        ]);

        return response()->json([
            'message' => 'Asignación de libro guardada correctamente.',
            'chapter' => [
                'id' => $chapter->id,
                'library_book_id' => $chapter->library_book_id,
                'chapter_number' => $chapter->chapter_number,
                'chapter_title' => $chapter->chapter_title,
                'text_content' => $chapter->text_content,
                'html_content' => $chapter->html_content,
            ],
        ], 201);
    }

    public function deleteAssignment(LibraryBook $book, LibraryBookAssignment $chapter)
    {
        if ((int) $chapter->library_book_id !== (int) $book->id) {
            return response()->json(['message' => 'Asignación inválida para este libro.'], 422);
        }

        if ($unauthorized = $this->ensureAdmin()) {
            return $unauthorized;
        }

        $chapter->delete();

        return response()->json(['message' => 'Capítulo eliminado correctamente.']);
    }

    private function ensureAdmin()
    {
        if ((string) session('user_type', 'guest') !== 'admin') {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return null;
    }
}
