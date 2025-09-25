@extends('layouts.app')

@section('title', 'Suivi de votre ticket')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <!-- En-tête -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-ticket-alt text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Suivi en direct</h1>
            <p class="text-gray-600">Votre ticket est en cours de traitement</p>
        </div>

        <!-- Carte principale du ticket -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-6">
            <!-- Bandeau coloré selon le statut -->
            <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600" id="status-bar"></div>
            
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Détails du ticket</h2>
                    <div class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium" id="status-badge">
                        En attente
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center space-x-2 mb-2">
                            <i class="fas fa-hashtag text-blue-500"></i>
                            <span class="text-gray-600 text-sm">Numéro</span>
                        </div>
                        <p class="text-lg font-mono font-bold text-gray-800">{{ $ticket->numero_ticket }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center space-x-2 mb-2">
                            <i class="fas fa-tag text-blue-500"></i>
                            <span class="text-gray-600 text-sm">Catégorie</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-800 capitalize">{{ $ticket->category }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fas fa-hospital text-blue-500"></i>
                        <span class="text-gray-600 text-sm">Service</span>
                    </div>
                    <p class="text-lg font-semibold text-gray-800">{{ $ticket->service->name }}</p>
                </div>
            </div>
        </div>

        <!-- Carte de position en temps réel -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 mb-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                </div>
                
                <div id="position-message" class="space-y-3">
                    <!-- Le contenu sera mis à jour par JavaScript -->
                    <div class="flex justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                    </div>
                    <p class="text-gray-600">Calcul de votre position...</p>
                </div>

                <!-- Barre de progression -->
                <div class="mt-6">
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Début de file</span>
                        <span>Votre position</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-green-500 h-3 rounded-full transition-all duration-1000" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructions selon le statut -->
        <div id="instructions" class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                <h3 class="text-lg font-semibold text-gray-800">Instructions</h3>
            </div>
            <p class="text-gray-600" id="instruction-text">
                Veuillez patienter pendant que nous calculons votre position...
            </p>
        </div>

        <!-- Pied de page -->
        <div class="text-center mt-8 text-gray-500 text-sm">
            <p>Mis à jour automatiquement toutes les 3 secondes</p>
            <p class="mt-1">Dernière actualisation : <span id="last-update">{{ now()->format('H:i:s') }}</span></p>
        </div>
    </div>
</div>

<style>
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.status-called {
    background: linear-gradient(135deg, #10B981, #059669);
}

.status-waiting {
    background: linear-gradient(135deg, #3B82F6, #2563EB);
}

.status-completed {
    background: linear-gradient(135deg, #6B7280, #4B5563);
}
</style>

<script>
function refreshPosition() {
    fetch(`/patient/tickets/{{ $ticket->id }}/position`)
        .then(res => res.json())
        .then(data => {
            // Mettre à jour l'heure de dernière actualisation
            document.getElementById('last-update').textContent = new Date().toLocaleTimeString('fr-FR');
            
            // Mettre à jour le statut
            document.getElementById('ticket-status').innerText = data.status;
            
            let statusBar = document.getElementById('status-bar');
            let statusBadge = document.getElementById('status-badge');
            let positionMessage = document.getElementById('position-message');
            let progressBar = document.getElementById('progress-bar');
            let instructionText = document.getElementById('instruction-text');
            let instructions = document.getElementById('instructions');

            let message = '';
            let progress = 0;
            let badgeClass = '';
            let barClass = '';
            let instruction = '';

            if(data.status === 'en_attente') {
                if(data.position > 1) {
                    message = `
                        <div class="mb-4">
                            <div class="text-4xl font-bold text-blue-600">${data.position - 1}</div>
                            <p class="text-gray-600">personne(s) avant vous</p>
                        </div>
                        <p class="text-gray-700">Votre position actuelle dans la file</p>
                    `;
                    progress = Math.max(10, 100 - ((data.position - 1) * 5));
                    badgeClass = 'bg-blue-100 text-blue-800';
                    barClass = 'status-waiting';
                    instruction = 'Patientez dans la salle d\'attente, vous serez appelé prochainement.';
                } else if(data.position === 1) {
                    message = `
                        <div class="animate-pulse mb-4">
                            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-exclamation text-yellow-600 text-2xl"></i>
                            </div>
                            <p class="text-yellow-600 font-bold text-lg">Vous êtes le prochain !</p>
                        </div>
                        <p class="text-gray-700">Préparez-vous à être appelé</p>
                    `;
                    progress = 95;
                    badgeClass = 'bg-yellow-100 text-yellow-800';
                    barClass = 'status-waiting';
                    instruction = 'Restez attentif, vous serez appelé dans quelques instants.';
                }
            } else if(data.status === 'appele') {
                message = `
                    <div class="animate-pulse mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-check text-green-600 text-2xl"></i>
                        </div>
                        <p class="text-green-600 font-bold text-lg">C'est votre tour !</p>
                    </div>
                    <p class="text-gray-700">Rendez-vous au service concerné</p>
                `;
                progress = 100;
                badgeClass = 'bg-green-100 text-green-800';
                barClass = 'status-called';
                instruction = 'Présentez-vous immédiatement au service avec votre pièce d\'identité.';
            } else {
                message = `
                    <div class="mb-4">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-info text-gray-600 text-2xl"></i>
                        </div>
                        <p class="text-gray-600">Ticket ${data.status}</p>
                    </div>
                `;
                badgeClass = 'bg-gray-100 text-gray-800';
                barClass = 'status-completed';
                instruction = 'Votre consultation est terminée. Merci de votre visite.';
            }

            // Appliquer les changements
            statusBar.className = `h-2 ${barClass}`;
            statusBadge.className = `px-3 py-1 ${badgeClass} rounded-full text-sm font-medium`;
            statusBadge.textContent = data.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
            
            positionMessage.innerHTML = message;
            progressBar.style.width = `${progress}%`;
            instructionText.textContent = instruction;

            // Changer la couleur de la barre de progression
            if (progress < 50) {
                progressBar.className = 'bg-gradient-to-r from-blue-500 to-blue-400 h-3 rounded-full transition-all duration-1000';
            } else if (progress < 90) {
                progressBar.className = 'bg-gradient-to-r from-blue-500 to-yellow-500 h-3 rounded-full transition-all duration-1000';
            } else {
                progressBar.className = 'bg-gradient-to-r from-blue-500 to-green-500 h-3 rounded-full transition-all duration-1000';
            }

            // Animation pour les instructions importantes
            if(data.status === 'appele' || (data.status === 'en_attente' && data.position === 1)) {
                instructions.classList.add('animate-pulse');
            } else {
                instructions.classList.remove('animate-pulse');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('position-message').innerHTML = `
                <div class="text-red-500">
                    <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                    <p>Erreur de connexion</p>
                </div>
            `;
        });
}

// Démarrer le suivi
document.addEventListener('DOMContentLoaded', function() {
    // Premier chargement
    refreshPosition();
    
    // Rafraîchir toutes les 3 secondes
    setInterval(refreshPosition, 3000);

    // Animation d'entrée
    const elements = document.querySelectorAll('.bg-white');
    elements.forEach((el, index) => {
        el.style.transform = 'translateY(20px)';
        el.style.opacity = '0';
        
        setTimeout(() => {
            el.style.transition = 'all 0.6s ease-out';
            el.style.transform = 'translateY(0)';
            el.style.opacity = '1';
        }, index * 200);
    });
});
</script>
@endsection