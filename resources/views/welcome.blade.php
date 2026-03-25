<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

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
                font-family: 'Figtree', sans-serif;
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
                font-family: 'Roboto Condensed', sans-serif;
            }

            .btn-login {
                background-color: #443C3D;
                color: white;
                border: none;
                font-family: 'Roboto Condensed', sans-serif;
            }

            .btn-login:hover {
                background-color: #5a5250;
            }

            .btn-guest {
                background-color: #E2D8CC;
                color: #443C3D;
                border: 2px solid #443C3D;
                font-family: 'Roboto Condensed', sans-serif;
            }

            .btn-guest:hover {
                background-color: #D0C4B4;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center p-4">
        <div class="card-container rounded-3xl shadow-2xl py-16 px-10 max-w-sm w-full text-center">
            <!-- Icon Circle -->
            <div class="flex justify-center mb-4">
                <div class="logo-icon"></div>
            </div>

            <!-- Title -->
            <h1 class="title-text text-4xl font-semibold mb-3">Bienvenido</h1>
            
            <!-- Subtitle -->
            <p class="subtitle-text text-sm mb-8">Selecciona cómo deseas ingresar</p>

            <!-- Buttons Container -->
            <div class="space-y-3">
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="btn-login flex items-center justify-center gap-2 font-semibold py-4 px-12 rounded-xl transition duration-200 w-full">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </a>

                <!-- Guest Button -->
                <a href="{{ route('guest') }}" class="btn-guest flex items-center justify-center gap-2 font-semibold py-4 px-12 rounded-xl transition duration-200 w-full">
                    <i class="fas fa-user"></i> 
                    Ingresar como Visitante
                </a>
            </div>
        </div>
    </body>
</html>
