<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - SAMATOUR</title>
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
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e40af 0%, #3b82f6 100%);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>

<body class="flex h-screen bg-gradient-to-br from-medical-light via-white to-blue-50 font-sans">
    <!-- Sidebar moderne -->
    <aside class="w-80 sidebar-gradient text-white relative overflow-hidden">
        <!-- Effet de décoration -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -translate-x-24 translate-y-24"></div>
        
        <div class="relative z-10 p-8 h-full flex flex-col">
            <!-- Logo et branding -->
            <div class="mb-12">
                <div class="flex items-center space-x-3 mb-2">
                                       <img src="{{ asset('images/logo.png') }}" alt="Logo SamaTour" class="w-12 h-12 rounded-xl shadow">

                    <h1 class="text-2xl font-bold">SAMATOUR</h1>
                </div>
                <p class="text-blue-100 text-sm opacity-80">Suivi médical intelligent</p>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2 flex-1">
                <a href="{{ route('patient.dashboard') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group">
                    <i class="fas fa-chart-dashboard w-5 text-center text-blue-200 group-hover:text-white"></i>
                    <span class="font-medium">Tableau de bord</span>
                </a>
                
                <a href="{{ route('patient.reserve') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group">
                    <i class="fas fa-ticket w-5 text-center text-blue-200 group-hover:text-white"></i>
                    <span class="font-medium">Réserver un ticket</span>
                </a>
                
                <a href="{{ route('patient.tickets') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group">
                    <i class="fas fa-list-check w-5 text-center text-blue-200 group-hover:text-white"></i>
                    <span class="font-medium">Mes tickets</span>
                </a>
                
                <!-- Bouton principal - Suivre mon rang -->
                <a href="{{ route('patient.suivre') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 bg-white text-medical-blue font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-6">
                    <i class="fas fa-eye w-5 text-center"></i>
                    <span>Suivre mon rang</span>
                    <i class="fas fa-arrow-right ml-auto text-sm"></i>
                </a>

                <!-- <a href="#" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 hover:bg-white/10 group">
                    <i class="fas fa-bell w-5 text-center text-blue-200 group-hover:text-white"></i>
                    <span class="font-medium">Notifications</span>
                    <span class="ml-auto bg-white/20 px-2 py-1 rounded-full text-xs">3</span>
                </a> -->
            </nav>

            <!-- Profil utilisateur -->
            <div class="mt-auto pt-8 border-t border-white/20">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center font-semibold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-blue-100 text-xs opacity-80">Patient</p>
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
        </div>
    </aside>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col min-h-0">
        <!-- Header moderne -->
        <header class="glass-effect shadow-sm p-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                <p class="text-gray-600 text-sm mt-1">Bienvenue sur votre espace personnel</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 bg-white/80 rounded-xl px-4 py-2 shadow-sm">
                    <div class="w-3 h-3 bg-medical-green rounded-full animate-pulse"></div>
                    <span class="text-gray-700 font-medium">En ligne</span>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-gray-600 text-sm">Dernière connexion: Aujourd'hui</p>
                </div>
            </div>
        </header>

        <!-- Contenu -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>