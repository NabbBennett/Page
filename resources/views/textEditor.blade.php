<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editor de Texto</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            body {
                margin: 0;
                font-family: 'Figtree', sans-serif;
                background: #443C3D;
            }
        </style>
    </head>
    <body>
        <div id="editorModal" style="position: relative; width: 100%; height: 100vh;">
            @include('partials.textEditorApp')
        </div>
    </body>
</html>
