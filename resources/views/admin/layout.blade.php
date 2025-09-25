<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
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
=======
    <title>@yield('title') - Espace Admin SAMATOUR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        },
                        medical: {
                            blue: '#1e40af',
                            teal: '#0d9488',
                            green: '#10b981',
                            light: '#f0f9ff'
                        },
                        admin: {
                            purple: '#7c3aed',
                            indigo: '#4f46e5',
                            dark: '#1e1b4b'
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e1b4b 0%, #3730a3 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #10b981;
        }
        
        .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
        }
    </style>
</head>

<body class="flex h-screen bg-gradient-to-br from-gray-50 to-blue-50 font-sans">

    <!-- Sidebar moderne -->
    <aside class="w-64 sidebar-gradient text-white relative overflow-hidden flex flex-col">
        <!-- Éléments décoratifs -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -translate-x-24 translate-y-24"></div>
        
        <div class="relative z-10 p-6 flex flex-col h-full">
            <!-- En-tête SAMATOUR Admin -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SamaTour" class="w-12 h-12 rounded-xl shadow">

                    <div>
                        <h1 class="text-xl font-bold">SAMATOUR</h1>
                        <p class="text-indigo-200 text-xs">Espace Administration</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-1 flex-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group relative nav-item">
                    <i class="fas fa-chart-bar w-5 text-center text-indigo-200 group-hover:text-white"></i>
                    <span class="font-medium">Tableau de bord</span>
                </a>
                
                <a href="{{ route('admin.services') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group relative nav-item">
                    <i class="fas fa-hospital w-5 text-center text-indigo-200 group-hover:text-white"></i>
                    <span class="font-medium">Services</span>
                </a>
                
                <a href="{{ route('admin.tickets') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group relative nav-item">
                    <i class="fas fa-ticket-alt w-5 text-center text-indigo-200 group-hover:text-white"></i>
                    <span class="font-medium">Tickets</span>
                    <!-- <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">12</span> -->
                </a>
                
                <a href="{{ route('admin.users') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group relative nav-item">
                    <i class="fas fa-users w-5 text-center text-indigo-200 group-hover:text-white"></i>
                    <span class="font-medium">Patients</span>
                </a>
                
                <!-- Section Statistiques -->
                <!-- <div class="mt-8 pt-6 border-t border-white/20">
                    <p class="text-indigo-200 text-xs uppercase tracking-wider mb-3">Statistiques</p>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-indigo-200">Tickets aujourd'hui</span>
                            <span class="font-semibold">24</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-indigo-200">Patients actifs</span>
                            <span class="font-semibold">156</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-indigo-200">Temps moyen</span>
                            <span class="font-semibold">18min</span>
                        </div>
                    </div>
                </div> -->
            </nav>

            <!-- Section déconnexion -->
            <div class="mt-auto pt-6 border-t border-white/20">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center font-semibold text-white">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="notification-dot"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium truncate text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-indigo-200 text-xs">Administrateur</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-white/10 rounded-xl hover:bg-white/20 transition-all duration-300 text-sm font-medium">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
>>>>>>> origin/amina
        </div>
    </aside>

    <!-- Contenu principal -->
<<<<<<< HEAD
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
=======
    <div class="flex-1 flex flex-col min-h-0 overflow-hidden">
        <!-- Topbar moderne -->
        <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-gray-200">
            <div>
                <h1 class="text-xl font-bold text-gray-800">@yield('page-title')</h1>
                <p class="text-gray-600 text-sm mt-1">Gestion de l'établissement médical</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Recherche -->
                <div class="relative">
                    <input type="text" 
                           placeholder="Rechercher..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                
                <!-- Notifications -->
                <!-- <div class="relative">
                    <button class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-gray-200 transition-colors relative">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </button>
                </div> -->
                
                <!-- Profil -->
                <div class="flex items-center space-x-3 bg-gray-50 rounded-xl px-4 py-2">
                    <div class="text-right">
                        <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-gray-600 text-xs">En ligne</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-medical-blue to-medical-teal rounded-full flex items-center justify-center text-white font-semibold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Indicateurs rapides -->
        <!-- <div class="bg-white border-b border-gray-200 p-4">
            <div class="grid grid-cols-4 gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-ticket-alt text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">5</p>
                        <p class="text-gray-600 text-sm">Tickets en attente</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-check text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">6</p>
                        <p class="text-gray-600 text-sm">Patients actifs</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">15min</p>
                        <p class="text-gray-600 text-sm">Temps moyen</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-orange-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">0</p>
                        <p class="text-gray-600 text-sm">Urgences</p>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Contenu -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Marquer l'élément de navigation actif
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                const link = item.getAttribute('href');
                if (currentPath.includes(link) && link !== '/') {
                    item.classList.add('active');
                }
            });
            
            // Animation d'entrée pour les indicateurs
            const indicators = document.querySelectorAll('.flex.items-center.space-x-3');
            indicators.forEach((indicator, index) => {
                indicator.style.opacity = '0';
                indicator.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    indicator.style.transition = 'all 0.5s ease-out';
                    indicator.style.opacity = '1';
                    indicator.style.transform = 'translateX(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
>>>>>>> origin/amina
