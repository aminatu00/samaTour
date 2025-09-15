<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Bienvenue dans l’espace Admin</h1>
            
            <!-- Bouton de déconnexion -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Déconnexion
                </button>
            </form>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold">Gestion des utilisateurs</h2>
                <p class="text-gray-600">Créer, modifier ou supprimer des agents et patients.</p>
            </div>
            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold">Rapports</h2>
                <p class="text-gray-600">Voir les statistiques et rapports du système.</p>
            </div>
        </div>
    </div>
</body>
</html>
