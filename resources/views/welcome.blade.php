<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #443C3D;
            }
            
            .card-container {
                background-color: #E2D8CC;
            }

            .icon-circle {
                background-color: #C4B8A8;
                border: 4px solid #443C3D;
            }

            .icon-circle svg {
                color: #443C3D;
            }

            .title-text {
                color: #443C3D;
            }

            .subtitle-text {
                color: #9e8e7e;
            }

            .btn-login {
                background-color: #443C3D;
                color: white;
                border: none;
            }

            .btn-login:hover {
                background-color: #5a5250;
            }

            .btn-guest {
                background-color: #E2D8CC;
                color: #443C3D;
                border: 2px solid #443C3D;
            }

            .btn-guest:hover {
                background-color: #D0C4B4;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center p-4">
        <div class="card-container rounded-3xl shadow-2xl p-16 max-w-sm w-full text-center">
            <!-- Icon Circle -->
            <div class="flex justify-center mb-8">
                <div class="icon-circle w-24 h-24 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h1 class="title-text text-4xl font-bold mb-3">Bienvenido</h1>
            
            <!-- Subtitle -->
            <p class="subtitle-text text-sm mb-8">Selecciona cómo deseas ingresar</p>

            <!-- Buttons Container -->
            <div class="space-y-3">
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="btn-login flex items-center justify-center gap-2 font-semibold py-4 px-12 rounded-xl transition duration-200 w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm6-10V7a3 3 0 00-3-3H9a3 3 0 00-3 3v4h12V7z" />
                    </svg>
                    Iniciar Sesión
                </a>

                <!-- Guest Button -->
                <a href="{{ route('guest') }}" class="btn-guest flex items-center justify-center gap-2 font-semibold py-4 px-12 rounded-xl transition duration-200 w-full">
                    <i class="fas fa-user-secret"></i> 
                    Ingresar como Visitante
                </a>
            </div>
        </div>
    </body>
</html>
