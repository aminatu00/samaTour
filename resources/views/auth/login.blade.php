<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SAMATOUR</title>
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
                        'float': 'float 6s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-medical-light via-white to-blue-50 font-sans flex items-center justify-center p-4">
    <div class="flex w-full max-w-6xl rounded-3xl shadow-2xl overflow-hidden">
        <!-- Section illustration -->
        <div class="hidden lg:flex flex-1 gradient-bg text-white p-8 relative overflow-hidden">
            <!-- Éléments décoratifs -->
            <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full -translate-x-16 -translate-y-16"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 bg-white/10 rounded-full translate-x-24 translate-y-24"></div>
            
            <div class="relative z-10 flex flex-col justify-center items-center text-center w-full">
                <div class="mb-8 animate-float">
                    <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center mb-4 mx-auto">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SamaTour" class="w-12 h-12 rounded-xl shadow">
                    </div>
                    <h1 class="text-4xl font-bold">SAMATOUR</h1>
                    <p class="text-blue-100 mt-2">Votre suivi médical intelligent</p>
                </div>
                
                <div class="glass-effect rounded-2xl p-6 max-w-md">
                    <h2 class="text-xl font-bold mb-4">Bienvenue sur SAMATOUR</h2>
                    <p class="text-blue-100">
                        Accédez à votre espace patient pour suivre votre rang en temps réel, 
                        réserver des tickets et simplifier votre parcours médical.
                    </p>
                    
                    <div class="mt-6 space-y-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-300"></i>
                            <span>Suivi en temps réel de votre position</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-300"></i>
                            <span>Réservation de tickets simplifiée</span>
                        </div>
                        <!-- <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-300"></i>
                            <span></span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulaire de connexion -->
        <div class="flex-1 bg-white p-8 lg:p-12">
            <div class="max-w-md mx-auto">
                <!-- En-tête mobile -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-medical-blue to-medical-teal rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart-pulse text-white text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">SAMATOUR</h1>
                    <p class="text-gray-600">Votre suivi médical intelligent</p>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Connexion à votre compte</h2>
                <p class="text-gray-600 mb-8">Entrez vos identifiants pour accéder à votre espace</p>
                
                <!-- Messages de statut -->
                <div class="mb-6" id="session-status">
                    <!-- Les messages de statut de session seront injectés ici -->
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-medical-blue"></i>Adresse email
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                autocomplete="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                                placeholder="votre@email.com"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-red-600" id="email-error">
                            <!-- Les erreurs email seront injectées ici -->
                        </div>
                    </div>
                    
                    <!-- Mot de passe -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-lock mr-2 text-medical-blue"></i>Mot de passe
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-medical-blue hover:text-medical-blue/80 transition-colors">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                autocomplete="current-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                                placeholder="Votre mot de passe"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="togglePassword">
                                <i class="fas fa-eye text-gray-400"></i>
                            </button>
                        </div>
                        <div class="mt-2 text-sm text-red-600" id="password-error">
                            <!-- Les erreurs password seront injectées ici -->
                        </div>
                    </div>
                    
                    <!-- Se souvenir de moi -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            name="remember" 
                            type="checkbox" 
                            class="w-4 h-4 text-medical-blue border-gray-300 rounded focus:ring-medical-blue"
                        >
                        <label for="remember_me" class="ml-2 text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    
                    <!-- Bouton de connexion -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-medical-blue to-medical-teal text-white py-3 px-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </button>
                    
                    <!-- Lien d'inscription -->
                    <div class="text-center pt-4 border-t border-gray-200 mt-6">
                        <p class="text-gray-600">
                            Nouveau patient ? 
                           <a href="{{ route('register') }}" class="text-medical-blue font-medium hover:text-medical-blue/80 transition-colors">
    Créer un compte
</a>

                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Afficher/masquer le mot de passe
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Animation d'entrée
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('input, button, label, p, h2');
            formElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });
        
        // Simulation des messages d'erreur (à remplacer par votre logique réelle)
        // Cette partie simule l'affichage des erreurs de validation
        function simulateErrors() {
            // Cette fonction est à titre d'exemple seulement
            // Dans votre application réelle, ces messages viendront de votre backend
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const sessionStatus = document.getElementById('session-status');
            
            // Exemple d'affichage d'erreur (à supprimer en production)
            // emailError.innerHTML = 'Cette adresse email est invalide.';
            // passwordError.innerHTML = 'Le mot de passe doit contenir au moins 8 caractères.';
            // sessionStatus.innerHTML = '<div class="p-3 bg-red-100 text-red-700 rounded-lg">Échec de la connexion. Veuillez vérifier vos identifiants.</div>';
        }
        
        // Appeler cette fonction pour tester l'affichage des erreurs
        // simulateErrors();
    </script>
</body>
</html>