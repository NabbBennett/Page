<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login - {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            .concert-one-regular {
                font-family: "Concert One", sans-serif;
                font-weight: 400;
                font-style: normal;
            }
            
            .roboto-condensed{
                font-family: "Roboto Condensed", sans-serif;
                font-optical-sizing: auto;
                font-weight: <weight>;
                font-style: normal;
            }

            body {
                font-family: 'Roboto Condensed', sans-serif;
                background-color: #443C3D;
            }
            
            .card-container {
                background-color: #E2D8CC;
            }

            .logo-icon{
                width: 150px;
                height: 150px;
                background-color: #443C3D;
                -webkit-mask: url('/storage/photo/NABBLOGO_BLANCO.png') center / contain no-repeat;
                mask: url('/storage/photo/NABBLOGO_BLANCO.png') center / contain no-repeat;
            }

            .title-text {
                color: #443C3D;
                font-family: 'Concert One', sans-serif;
            }

            .subtitle-text {
                color: #9e8e7e;
            }

            .form-label {
                color: #443C3D;
                font-weight: 600;
            }

            .form-input {
                border: 2px solid #443C3D;
                color: #443C3D;
            }

            .form-input::placeholder {
                color: #b5a89b;
            }

            .form-input:focus {
                outline: none;
                border-color: #5a5250;
                box-shadow: 0 0 0 3px rgba(68, 60, 61, 0.1);
            }

            .btn-login {
                background-color: #443C3D;
                color: white;
                border: none;
                font-weight: 600;
            }

            .btn-login:hover {
                background-color: #5a5250;
            }

            .btn-back {
                background-color: #E2D8CC;
                color: #443C3D;
                border: 2px solid #443C3D;
                font-weight: 600;
            }

            .btn-back:hover {
                background-color: #D0C4B4;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center p-4">
        <div class="card-container rounded-3xl shadow-2xl p-8 max-w-md w-full">
            <!-- Icon Circle -->
            <div class="flex justify-center">
                <div class="logo-icon"></div>
            </div>

            <!-- Title -->
            <h1 class="title-text text-4xl font-bold text-center mb-2">ACCESO</h1>
            
            <!-- Subtitle -->
            <p class="subtitle-text text-sm text-center mb-6">Ingresa tus credenciales</p>

            <!-- Login Form -->
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf

                @if($errors->has('credentials'))
                    <div class="rounded-xl border-2 border-red-600 bg-red-100 text-red-700 px-4 py-3 text-sm">
                        {{ $errors->first('credentials') }}
                    </div>
                @endif

                <!-- Usuario Field -->
                <div>
                    <label for="username" class="form-label block mb-2 text-sm">Usuario</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Who are you?" 
                        value="{{ old('username') }}"
                        class="form-input w-full py-3 px-4 rounded-xl transition duration-200"
                        required
                    >
                </div>

                <!-- Contraseña Field -->
                <div>
                    <label for="password" class="form-label block mb-2 text-sm">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••" 
                        class="form-input w-full py-3 px-4 rounded-xl transition duration-200"
                        required
                    >
                </div>

                <!-- Buttons Container -->
                <div class="space-y-3 pt-2">
                    <!-- Login Button -->
                    <button type="submit" class="btn-login w-full py-3 px-4 rounded-xl transition duration-200">
                        Iniciar Sesión
                    </button>

                    <!-- Back Button -->
                    <a href="/" class="btn-back block w-full py-3 px-4 rounded-xl transition duration-200 text-center">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </body>
</html>
