<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/guest', [AuthController::class, 'guest'])->name('guest');

Route::middleware('session.auth')->group(function () {
Route::get('/dashboard', function () {
    $userType = session('user_type');
    $userName = session('user_name', 'Usuario');

    return view('dashboard', [
        'userType' => $userType,
        'userName' => $userName
    ]);
})->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/text-editor', function () {
    return view('textEditor');
})->name('text-editor');

Route::get('/red-social', function () {
    return view('redSocial', [
        'userType' => session('user_type', 'guest'),
    ]);
})->name('red-social');

Route::get('/biblioteca', [LibraryController::class, 'index'])->name('biblioteca');
Route::get('/archivos', [FileController::class, 'index'])->name('archivos');

Route::get('/archivos/escritos', [FileController::class, 'writings']);
Route::post('/archivos/escritos', [FileController::class, 'storeWriting']);
Route::delete('/archivos/escritos/{writing}', [FileController::class, 'deleteWriting']);

Route::get('/archivos/carpetas', [FileController::class, 'folders']);
Route::post('/archivos/carpetas', [FileController::class, 'storeFolder']);
Route::put('/archivos/carpetas/{folder}', [FileController::class, 'updateFolder']);
Route::delete('/archivos/carpetas/{folder}', [FileController::class, 'deleteFolder']);

Route::get('/biblioteca/libros', [LibraryController::class, 'books']);
Route::post('/biblioteca/libros', [LibraryController::class, 'storeBook']);
Route::put('/biblioteca/libros/{book}', [LibraryController::class, 'updateBook']);
Route::delete('/biblioteca/libros/{book}', [LibraryController::class, 'deleteBook']);
Route::post('/biblioteca/libros/{book}/asignaciones', [LibraryController::class, 'storeAssignment']);
Route::delete('/biblioteca/libros/{book}/asignaciones/{chapter}', [LibraryController::class, 'deleteAssignment']);

Route::get('/music/playlists', [MusicController::class, 'playlists']);
Route::get('/music/media/{path}', [MusicController::class, 'media'])->where('path', '.*')->name('music.media');
Route::post('/music/upload-cover', [MusicController::class, 'uploadCover']);
Route::post('/music/playlists', [MusicController::class, 'storePlaylist']);
Route::put('/music/playlists/{playlist}', [MusicController::class, 'updatePlaylist']);
Route::delete('/music/playlists/{playlist}', [MusicController::class, 'deletePlaylist']);
Route::get('/music/tracks', [MusicController::class, 'tracks']);
Route::post('/music/tracks', [MusicController::class, 'storeTrack']);
Route::delete('/music/tracks/{track}', [MusicController::class, 'deleteTrack']);

Route::get('/social/data', [SocialController::class, 'data']);
Route::post('/social/posts', [SocialController::class, 'storePost']);
Route::delete('/social/posts/{post}', [SocialController::class, 'deletePost']);
Route::post('/social/posts/{post}/comments', [SocialController::class, 'storeComment']);
Route::delete('/social/comments/{comment}', [SocialController::class, 'deleteComment']);
Route::post('/social/profiles', [SocialController::class, 'storeProfile']);
Route::put('/social/profiles/{profile}', [SocialController::class, 'updateProfile']);
Route::delete('/social/profiles/{profile}', [SocialController::class, 'deleteProfile']);
});
