<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Espace Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 flex flex-col">
        <h2 class="text-xl font-bold mb-6">Menu Patient</h2>
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('patient.dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-200">Tableau de bord</a>
            <a href="{{ route('patient.reserve') }}" class="px-3 py-2 rounded hover:bg-gray-200">Réserver un ticket</a>
            <a href="{{ route('patient.tickets') }}" class="px-3 py-2 rounded hover:bg-gray-200">Mes tickets</a>
            
            {{-- Nouveau bouton suivre rang --}}
            <a href="{{ route('patient.suivre') }}" class="px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">
                Suivre mon rang
            </a>

             <a href="{{ route('patient.notifications') }}" class="flex items-center px-3 py-2 rounded hover:bg-gray-200 space-x-2">
                <i data-lucide="bell" class="w-5 h-5 text-red-500"></i>
                <span>Notifications</span>
            </a>
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
