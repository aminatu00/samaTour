<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sama Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-10 rounded-xl shadow-lg text-center">
        <h1 class="text-3xl font-bold mb-6">Bienvenue sur Sama Tour</h1>

        <div class="space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Login</a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Register</a>
        </div>
    </div>

</body>
</html>
