<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Espace Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 flex flex-col">
        <h2 class="text-xl font-bold mb-6">Menu Admin</h2>
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-200">Tableau de bord</a>
            <a href="{{ route('admin.services') }}" class="px-3 py-2 rounded hover:bg-gray-200">Services</a>
            <a href="{{ route('admin.tickets') }}" class="px-3 py-2 rounded hover:bg-gray-200">Tickets</a>
            <a href="{{ route('admin.users') }}" class="px-3 py-2 rounded hover:bg-gray-200">Patients</a>
        </nav>
        <div class="mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">@yield('page-title')</h1>
            <div>
                Bonjour, {{ auth()->user()->name }}
            </div>
        </header>

        <!-- Contenu -->
        <main class="p-6 flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>
