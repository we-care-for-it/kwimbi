<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Pagina niet gevonden</title>
    <!-- Correct Path for the Custom Theme CSS -->
    <link href="{{ asset('vendor/themes/default.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center w-full max-w-lg">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 mx-auto mb-4">
            <h1 class="text-4xl font-semibold text-gray-800 mb-4">404 - Pagina niet gevonden</h1>
            <p class="text-gray-600 mb-6">De pagina die je zoekt bestaat niet.</p>
            <a href="/" class="text-blue-600 hover:underline">Klik hier om terug te gaan</a>
        </div>
    </div>
</body>
</html>
