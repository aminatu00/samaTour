<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - SAMATOUR</title>
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
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
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
                    <p class="text-blue-100 mt-2">Rejoignez notre communauté médicale</p>
                </div>
                
                <div class="glass-effect rounded-2xl p-6 max-w-md">
                    <h2 class="text-xl font-bold mb-4">Créez votre compte patient</h2>
                    <p class="text-blue-100">
                        Inscrivez-vous pour bénéficier de tous les services SAMATOUR : 
                        suivi de rang en temps réel, réservation de tickets et notifications personnalisées.
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
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-300"></i>
                            <span>Historique de vos consultations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulaire d'inscription -->
        <div class="flex-1 bg-white p-8 lg:p-12">
            <div class="max-w-md mx-auto">
                <!-- En-tête mobile -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-medical-blue to-medical-teal rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">SAMATOUR</h1>
                    <p class="text-gray-600">Créez votre compte patient</p>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Inscription</h2>
                <p class="text-gray-600 mb-8">Remplissez le formulaire pour créer votre compte</p>
                
                <form method="POST" action="{{ route('register') }}" class="space-y-6" id="register-form">
                    @csrf
                    
                    <!-- Nom complet -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-medical-blue"></i>Nom complet
                        </label>
                        <div class="relative">
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                value="{{ old('name') }}" 
                                required 
                                autofocus 
                                autocomplete="name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                                placeholder="Votre nom complet"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-red-600" id="name-error">
                            <!-- Les erreurs name seront injectées ici -->
                        </div>
                    </div>
                    
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
                                autocomplete="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                                placeholder="votre@email.com"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-at text-gray-400"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-red-600" id="email-error">
                            <!-- Les erreurs email seront injectées ici -->
                        </div>
                    </div>
                    
                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-medical-blue"></i>Mot de passe
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                                placeholder="Créez un mot de passe sécurisé"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="togglePassword">
                                <i class="fas fa-eye text-gray-400"></i>
                            </button>
                        </div>
                        
                        <!-- Indicateur de force du mot de passe -->
                        <div class="mt-2">
                            <div class="flex space-x-1 mb-1">
                                <div id="strength-1" class="password-strength flex-1 bg-gray-200"></div>
                                <div id="strength-2" class="password-strength flex-1 bg-gray-200"></div>
                                <div id="strength-3" class="password-strength flex-1 bg-gray-200"></div>
                                <div id="strength-4" class="password-strength flex-1 bg-gray-200"></div>
                            </div>
                            <p id="password-feedback" class="text-xs text-gray-500">Le mot de passe doit contenir au moins 8 caractères</p>
                        </div>
                        
                        <div class="mt-2 text-sm text-red-600" id="password-error">
                            <!-- Les erreurs password seront injectées ici -->
                        </div>
                    </div>
                    
                    <!-- Confirmation du mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-medical-blue"></i>Confirmer le mot de passe
                        </label>
                        <div class="relative">
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                                placeholder="Confirmez votre mot de passe"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="togglePasswordConfirmation">
                                <i class="fas fa-eye text-gray-400"></i>
                            </button>
                        </div>
                        <div id="password-match" class="mt-2 text-sm text-green-600 hidden">
                            <i class="fas fa-check-circle mr-1"></i>Les mots de passe correspondent
                        </div>
                        <div class="mt-2 text-sm text-red-600" id="password_confirmation-error">
                            <!-- Les erreurs password_confirmation seront injectées ici -->
                        </div>
                    </div>
                    
                    <!-- Conditions d'utilisation -->
                    <div class="flex items-start space-x-3">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox" 
                            class="w-4 h-4 text-medical-blue border-gray-300 rounded focus:ring-medical-blue mt-1"
                            required
                        >
                        <label for="terms" class="text-sm text-gray-700">
                            J'accepte les 
                            <a href="#" class="text-medical-blue hover:text-medical-blue/80">conditions d'utilisation</a> 
                            et la 
                            <a href="#" class="text-medical-blue hover:text-medical-blue/80">politique de confidentialité</a>
                            de SAMATOUR
                        </label>
                    </div>
                    
                    <!-- Bouton d'inscription -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-medical-blue to-medical-teal text-white py-3 px-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300"
                        id="submit-button"
                    >
                        <i class="fas fa-user-plus mr-2"></i>Créer mon compte
                    </button>
                    
                    <!-- Lien de connexion -->
                    <div class="text-center pt-4 border-t border-gray-200 mt-6">
                        <p class="text-gray-600">
                            Déjà inscrit ? 
                            <a href="{{ route('login') }}" class="text-medical-blue font-medium hover:text-medical-blue/80 transition-colors">
                                Se connecter
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
        
        // Afficher/masquer la confirmation du mot de passe
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
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
        
        // Vérification de la force du mot de passe
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];
            const feedback = document.getElementById('password-feedback');
            
            // Réinitialiser les barres
            strengthBars.forEach(bar => {
                bar.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-green-500', 'bg-emerald-500');
                bar.classList.add('bg-gray-200');
            });
            
            let strength = 0;
            let message = 'Le mot de passe doit contenir au moins 8 caractères';
            
            if (password.length >= 8) {
                strength++;
                message = 'Faible';
            }
            
            if (password.length >= 10) {
                strength++;
            }
            
            if (/[A-Z]/.test(password) && /[a-z]/.test(password)) {
                strength++;
            }
            
            if (/[0-9]/.test(password) && /[^A-Za-z0-9]/.test(password)) {
                strength++;
            }
            
            // Mettre à jour les barres de force
            for (let i = 0; i < strength; i++) {
                if (strength === 1) {
                    strengthBars[i].classList.remove('bg-gray-200');
                    strengthBars[i].classList.add('bg-red-500');
                    message = 'Faible';
                } else if (strength === 2) {
                    strengthBars[i].classList.remove('bg-gray-200');
                    strengthBars[i].classList.add('bg-yellow-500');
                    message = 'Moyen';
                } else if (strength === 3) {
                    strengthBars[i].classList.remove('bg-gray-200');
                    strengthBars[i].classList.add('bg-green-500');
                    message = 'Fort';
                } else if (strength === 4) {
                    strengthBars[i].classList.remove('bg-gray-200');
                    strengthBars[i].classList.add('bg-emerald-500');
                    message = 'Très fort';
                }
            }
            
            feedback.textContent = message;
        });
        
        // Vérification de la correspondance des mots de passe
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            const matchIndicator = document.getElementById('password-match');
            
            if (confirmation.length > 0) {
                if (password === confirmation) {
                    matchIndicator.classList.remove('hidden');
                } else {
                    matchIndicator.classList.add('hidden');
                }
            } else {
                matchIndicator.classList.add('hidden');
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
        function simulateErrors() {
            // Cette fonction est à titre d'exemple seulement
            // Dans votre application réelle, ces messages viendront de votre backend
            const nameError = document.getElementById('name-error');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const passwordConfirmationError = document.getElementById('password_confirmation-error');
            
            // Exemple d'affichage d'erreur (à supprimer en production)
            // nameError.innerHTML = 'Le nom est obligatoire.';
            // emailError.innerHTML = 'Cette adresse email est déjà utilisée.';
            // passwordError.innerHTML = 'Le mot de passe doit contenir au moins 8 caractères.';
            // passwordConfirmationError.innerHTML = 'Les mots de passe ne correspondent pas.';
        }
        
        // Appeler cette fonction pour tester l'affichage des erreurs
        // simulateErrors();
    </script>
</body>
</html>