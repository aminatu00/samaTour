<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow h-screen p-6">
        <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
        <nav class="space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
                <i data-lucide="layout-dashboard"></i> Tableau de bord
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
                <i data-lucide="users"></i> Gestion utilisateurs
            </a>
            <a href="{{ route('admin.notifications') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
                <i data-lucide="bell"></i> Envoyer une notification
            </a>
            <!-- Lien pour la gestion des services -->
            <a href="{{ route('admin.services') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
                <i data-lucide="briefcase"></i> Gestion des services
            </a>
            <a href="{{ route('admin.settings') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
                <i data-lucide="settings"></i> Paramètres
            </a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Déconnexion
            </button>
        </form>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-6">@yield('page-title')</h1>
        @yield('content')
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
