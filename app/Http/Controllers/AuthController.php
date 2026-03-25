<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(): RedirectResponse|\Illuminate\View\View
    {
        if (session('user_logged_in')) {
            return redirect('/dashboard');
        }

        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        if (session('user_logged_in')) {
            return redirect('/dashboard');
        }

        $username = trim((string) $request->input('username', ''));
        $password = (string) $request->input('password', '');

        $admin = User::query()
            ->where('name', 'Nabb')
            ->first();

        if ($admin && hash_equals('Nabb', $username) && Hash::check($password, $admin->password)) {
            $request->session()->regenerate();
            session([
                'user_type' => 'admin',
                'user_logged_in' => true,
                'user_name' => $admin->name,
                'user_id' => $admin->id,
            ]);

            return redirect('/dashboard');
        }

        return back()->withErrors(['credentials' => 'Las credenciales no son válidas']);
    }

    public function guest(Request $request): RedirectResponse
    {
        $request->session()->regenerate();
        session([
            'user_type' => 'guest',
            'user_logged_in' => true,
            'user_name' => 'Visitante',
            'user_id' => null,
        ]);

        return redirect('/dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
