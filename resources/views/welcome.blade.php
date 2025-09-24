<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SAMATOUR - Votre suivi médical intelligent</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome dernière version -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-section {
            background-image: linear-gradient(rgba(30, 64, 175, 0.7), rgba(13, 148, 136, 0.7)), url('https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1932&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 64, 175, 0.3);
        }
        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Section Hero avec image de fond -->
    <div class="hero-section w-full min-h-screen flex items-center justify-center">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <!-- Contenu à gauche -->
                <div class="lg:w-1/2 text-white mb-10 lg:mb-0">
                    <div class="glass-effect rounded-3xl p-8 max-w-lg">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mr-4">
                                       <img src="{{ asset('images/logo.png') }}" alt="Logo SamaTour" class="w-12 h-12 rounded-xl shadow">
                            </div>
                            <h1 class="text-4xl font-bold">SAMATOUR</h1>
                        </div>
                        <p class="text-xl mb-2">Votre suivi médical intelligent</p>
                        <p class="text-white/80 mb-8">Réservez vos tickets et suivez votre rang en temps réel depuis chez vous</p>
                        
                        <!-- Boutons de connexion et inscription -->
                        <div class="space-y-4">
                            <a href="{{ route('login') }}" class="btn-primary w-full py-4 rounded-xl font-semibold text-lg flex items-center justify-center">
                                <i class="fa-solid fa-sign-in-alt mr-3"></i> Se connecter
                            </a>
                            <a href="{{ route('register') }}" class="btn-secondary w-full py-4 rounded-xl font-semibold text-lg flex items-center justify-center border border-white/30">
                                <i class="fa-solid fa-user-plus mr-3"></i> Créer un compte
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Contenu à droite -->
             
            </div>
            
            <!-- Section supplémentaire en bas -->
    
        </div>
    </div>

    <!-- Section Informations (optionnelle - défilement vers le bas) -->
    <div class="hidden bg-white py-16" id="more-info">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Comment ça marche ?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">SAMATOUR simplifie votre parcours médical en 3 étapes simples</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-mobile-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">1. Réservez</h3>
                    <p class="text-gray-600">Choisissez votre service et réservez un ticket depuis votre appareil</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-clock text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">2. Suivez</h3>
                    <p class="text-gray-600">Surveillez votre position en file d'attente en temps réel</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-bell text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">3. Allez-y</h3>
                    <p class="text-gray-600">Recevez une notification quand c'est votre tour</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animation pour faire défiler vers la section d'informations
        document.querySelector('.floating').addEventListener('click', function() {
            document.getElementById('more-info').scrollIntoView({ 
                behavior: 'smooth' 
            });
        });
        
        // Animation d'entrée pour les éléments
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.glass-effect, .feature-card');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    el.style.transition = 'all 0.8s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>
</html>
