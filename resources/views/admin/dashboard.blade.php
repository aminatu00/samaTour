<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow h-screen p-6">
    <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
    <nav class="space-y-4">
      <a href="javascript:void(0)" onclick="showSection('dashboard')" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
        <i data-lucide="layout-dashboard"></i> Tableau de bord
      </a>
      <a href="javascript:void(0)" onclick="showSection('users')" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
        <i data-lucide="users"></i> Gestion utilisateurs
      </a>
      <a href="javascript:void(0)" onclick="showSection('notifications')" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
        <i data-lucide="bell"></i> Envoyer une notification
      </a>
      <a href="javascript:void(0)" onclick="showSection('settings')" class="flex items-center gap-2 text-gray-700 hover:text-blue-500">
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
    <h1 class="text-3xl font-bold mb-6">Bienvenue dans l’espace Admin</h1>

    <!-- Section Tableau de bord (par défaut affichée) -->
    <div id="section-dashboard">
      <h2 class="text-2xl font-semibold mb-4">Tableau de bord</h2>
      <p class="text-gray-600">Résumé des statistiques et activités récentes.</p>

      <div class="grid grid-cols-3 gap-6 mt-4">
        <div class="bg-white p-6 shadow rounded-lg">
          <h3 class="text-lg font-semibold">Utilisateurs</h3>
          <p class="text-gray-600">Nombre total d’utilisateurs inscrits.</p>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
          <h3 class="text-lg font-semibold">Tickets</h3>
          <p class="text-gray-600">Suivi des réservations en cours.</p>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
          <h3 class="text-lg font-semibold">Notifications</h3>
          <p class="text-gray-600">Derniers messages envoyés.</p>
        </div>
      </div>
    </div>

    <!-- Section Utilisateurs -->
    <div id="section-users" class="hidden">
      <h2 class="text-2xl font-semibold mb-4">Gestion des utilisateurs</h2>
      <p class="text-gray-600">Créer, modifier ou supprimer des agents et patients.</p>
    </div>

    <!-- Section Notifications -->
    <div id="section-notifications" class="hidden">
      <h2 class="text-2xl font-semibold mb-4">Envoyer une notification</h2>

      <form action="{{ route('notifications.store') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Choisir le patient -->
        <div>
          <label class="block text-gray-700 mb-1">Sélectionner un patient</label>
          <select name="user_id" class="w-full border rounded p-2">
            @foreach($patients as $patient)
              <option value="{{ $patient->id }}">{{ $patient->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- Titre -->
        <div>
          <label class="block text-gray-700 mb-1">Titre</label>
          <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>

        <!-- Message -->
        <div>
          <label class="block text-gray-700 mb-1">Message</label>
          <textarea name="message" rows="4" class="w-full border rounded p-2" required></textarea>
        </div>

        <!-- Bouton -->
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
          Envoyer
        </button>
      </form>
    </div>

    <!-- Section Paramètres -->
    <div id="section-settings" class="hidden">
      <h2 class="text-2xl font-semibold mb-4">Paramètres</h2>
      <p class="text-gray-600">Gérer les paramètres du système.</p>
    </div>

  </main>

  <script>
    lucide.createIcons();

    function showSection(section) {
      // cacher toutes les sections
      document.querySelectorAll('main > div').forEach(div => div.classList.add('hidden'));
      // afficher seulement celle choisie
      document.getElementById('section-' + section).classList.remove('hidden');
    }
  </script>
</body>
</html>
