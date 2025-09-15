<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Agent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Bienvenue dans l’espace Agent</h1>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
        Déconnexion
    </button>
</form>

        
        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="text-xl font-semibold">Tâches assignées</h2>
            <p class="text-gray-600">Consulter et gérer vos tâches.</p>
        </div>
    </div>
</body>
</html>
