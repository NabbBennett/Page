<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    // Credenciales hardcodeadas para el administrador único
    $username = request('username');
    $password = request('password');

    // Usuario admin con contraseña encriptada
    if ($username === 'ADMIN' && $password === 'admin123') {
        session(['user_type' => 'admin', 'user_logged_in' => true]);
        return redirect('/dashboard');
    }

    return back()->withErrors(['credentials' => 'Las credenciales no son válidas']);
})->name('admin.login');

Route::get('/guest', function () {
    // Crear sesión de visitante automáticamente
    session(['user_type' => 'guest', 'user_logged_in' => true, 'user_name' => 'Visitante']);
    return redirect('/dashboard');
})->name('guest');

Route::get('/dashboard', function () {
    if (!session('user_logged_in')) {
        return redirect('/');
    }
    
    $userType = session('user_type');
    $userName = session('user_name', 'Usuario');
    
    return view('dashboard', [
        'userType' => $userType,
        'userName' => $userName
    ]);
})->name('dashboard');

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

Route::get('/text-editor', function () {
    if (!session('user_logged_in')) {
        return redirect('/');
    }
    return view('textEditor');
})->name('text-editor');

Route::get('/red-social', function () {
    if (!session('user_logged_in')) {
        return redirect('/');
    }

    return view('redSocial', [
        'userType' => session('user_type', 'guest'),
    ]);
})->name('red-social');

Route::get('/biblioteca', function () {
    if (!session('user_logged_in')) {
        return redirect('/');
    }

    return view('biblioteca', [
        'userType' => session('user_type', 'guest'),
    ]);
})->name('biblioteca');

Route::get('/archivos', function () {
    if (!session('user_logged_in')) {
        return redirect('/');
    }

    return view('archivos', [
        'userType' => session('user_type', 'guest'),
    ]);
})->name('archivos');
