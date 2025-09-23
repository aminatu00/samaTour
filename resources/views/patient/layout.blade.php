<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Espace Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 flex flex-col">
        <h2 class="text-xl font-bold mb-6 flex items-center space-x-2">
            <i data-lucide="layout-dashboard" class="w-6 h-6 text-red-500"></i>
            <span>Menu Patient</span>
        </h2>
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('patient.dashboard') }}" class="flex items-center px-3 py-2 rounded hover:bg-gray-200 space-x-2">
                <i data-lucide="home" class="w-5 h-5 text-red-500"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="{{ route('patient.reserve') }}" class="flex items-center px-3 py-2 rounded hover:bg-gray-200 space-x-2">
                <i data-lucide="calendar-plus" class="w-5 h-5 text-red-500"></i>
                <span>Réserver un ticket</span>
            </a>
            <a href="{{ route('patient.tickets') }}" class="flex items-center px-3 py-2 rounded hover:bg-gray-200 space-x-2">
                <i data-lucide="ticket" class="w-5 h-5 text-red-500"></i>
                <span>Mes tickets</span>
            </a>
            <a href="{{ route('patient.notifications') }}" class="flex items-center px-3 py-2 rounded hover:bg-gray-200 space-x-2">
                <i data-lucide="bell" class="w-5 h-5 text-red-500"></i>
                <span>Notifications</span>
            </a>
        </nav>
        <div class="mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 space-x-2">
                    <i data-lucide="log-out" class="w-5 h-5 text-white"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold flex items-center space-x-2">
                <i data-lucide="file-text" class="w-6 h-6 text-red-500"></i>
                <span>@yield('page-title')</span>
            </h1>
            <div class="flex items-center space-x-2 text-gray-700">
                <i data-lucide="user" class="w-6 h-6 text-gray-600"></i>
                <span>Bonjour, {{ auth()->user()->name }}</span>
            </div>
        </header>

        <!-- Contenu -->
        <main class="p-6 flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
