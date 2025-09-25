@extends('admin.layout')

@section('title', 'Dashboard Admin/Agent')
<<<<<<< HEAD

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Tableau de bord Admin/Agent</h1>

    {{-- Résumé --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold text-gray-700">Tickets en attente</h2>
            <p class="text-2xl font-bold" id="waiting-count">{{ $waitingTicketsCount }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold text-gray-700">Services</h2>
            <p class="text-2xl font-bold">{{ $servicesCount }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold text-gray-700">Patients totaux</h2>
            <p class="text-2xl font-bold">{{ $patientsCount }}</p>
        </div>
    </div>

    {{-- Files d’attente par service --}}
    <h2 class="text-xl font-bold mb-4">Files d’attente</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($services as $service)
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold mb-3">{{ $service->name }}</h3>
                <div id="queue-{{ $service->id }}">
                    @include('admin.partials.queue', [
                        'tickets' => $service->tickets()->where('status', 'en_attente')->orderBy('created_at')->get()
                    ])
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>

=======
@section('page-title', 'Tableau de bord - Administration')

@section('content')
<div class="space-y-6">
    <!-- En-tête avec indicateurs clés -->
    <div class="bg-gradient-to-r from-admin-purple to-admin-indigo rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Tableau de bord administratif</h1>
                <p class="text-purple-100 text-lg">Gestion en temps réel des files d'attente</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold">{{ now()->format('H:i') }}</div>
                <div class="text-purple-200 text-sm">{{ now()->isoFormat('dddd D MMMM YYYY') }}</div>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques principales -->
    <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-800" id="waiting-count">{{ $waitingTicketsCount }}</div>
                    <div class="text-gray-600">Tickets en attente</div>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-red-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Depuis ce matin</span>
                    <span class="font-medium text-green-500">+12%</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-800">{{ $servicesCount }}</div>
                    <div class="text-gray-600">Services actifs</div>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hospital text-blue-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Services ouverts</span>
                    <span class="font-medium text-green-500">100%</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-800">{{ $patientsCount }}</div>
                    <div class="text-gray-600">Patients totaux</div>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Ce mois</span>
                    <span class="font-medium text-green-500">+8%</span>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Files d'attente par service -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-list-ol text-purple-500 text-lg"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Files d'attente en temps réel</h2>
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <i class="fas fa-sync-alt animate-spin"></i>
                    <span>Mise à jour automatique</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6">
            @foreach($services as $service)
                @php
                    $tickets = $service->tickets()->where('status', 'en_attente')->orderBy('created_at')->get();
                    $urgentCount = $tickets->where('category', 'urgent')->count();
                @endphp

                <div class="border border-gray-200 rounded-xl hover:shadow-md transition-shadow duration-300">
                    <!-- En-tête du service -->
                    <div class="bg-gradient-to-r from-gray-50 to-white p-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-stethoscope text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $service->name }}</h3>
                                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                                        <span>{{ $tickets->count() }} en attente</span>
                                        @if($urgentCount > 0)
                                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">
                                                {{ $urgentCount }} urgent(s)
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-500">Temps moyen</div>
                                <div class="font-semibold text-gray-800">15min</div>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des tickets -->
                    <div id="queue-{{ $service->id }}" class="divide-y divide-gray-100">
                        @include('admin.partials.queue', ['tickets' => $tickets])
                    </div>

                    <!-- Pied de carte -->
                    <div class="p-3 bg-gray-50 border-t border-gray-200">
                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span>Dernière mise à jour: {{ now()->format('H:i:s') }}</span>
                            <button class="call-next-ticket bg-medical-blue text-white px-3 py-1 rounded-lg text-xs font-medium hover:bg-medical-blue/90 transition-colors"
                                    data-service="{{ $service->id }}">
                                Appeler suivant
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.tickets') }}" class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 text-center hover:shadow-xl transition-shadow duration-300">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-ticket-alt text-blue-500 text-xl"></i>
            </div>
            <div class="font-semibold text-gray-800">Gérer les tickets</div>
        </a>

        <a href="{{ route('admin.services') }}" class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 text-center hover:shadow-xl transition-shadow duration-300">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-cog text-green-500 text-xl"></i>
            </div>
            <div class="font-semibold text-gray-800">Services</div>
        </a>

        <a href="{{ route('admin.users') }}" class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 text-center hover:shadow-xl transition-shadow duration-300">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-users text-purple-500 text-xl"></i>
            </div>
            <div class="font-semibold text-gray-800">Patients</div>
        </a>

        <a href="#" class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 text-center hover:shadow-xl transition-shadow duration-300">
            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-chart-bar text-orange-500 text-xl"></i>
            </div>
            <div class="font-semibold text-gray-800">Rapports</div>
        </a>
    </div>
</div>

<style>
    .ticket-card {
        transition: all 0.3s ease;
    }
    
    .ticket-card:hover {
        transform: translateX(5px);
    }
    
    .urgent-ticket {
        border-left: 4px solid #ef4444;
        background-color: #fef2f2;
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
</style>

<script>
// Fonction pour rafraîchir une file d'attente spécifique
>>>>>>> origin/amina
function refreshQueue(serviceId) {
    fetch(`/admin/services/${serviceId}/queue`)
        .then(res => res.text())
        .then(html => {
            if(html.trim().length > 0){
                document.querySelector(`#queue-${serviceId}`).innerHTML = html;
<<<<<<< HEAD
            }
        });
}

setInterval(() => {
    @foreach($services as $service)
        refreshQueue({{ $service->id }});
    @endforeach
}, 5000);



// Quand on clique sur "Appeler"
=======
                
                // Mettre à jour le compteur de tickets en attente
                updateWaitingCount();
            }
        })
        .catch(error => {
            console.error('Error refreshing queue:', error);
        });
}

// Mettre à jour le compteur global de tickets en attente
function updateWaitingCount() {
    // Cette fonction pourrait appeler une API pour obtenir le nombre total
    // Pour l'instant, nous allons simplement incrémenter/décrémenter visuellement
    const waitingCountElement = document.getElementById('waiting-count');
    const currentCount = parseInt(waitingCountElement.textContent);
    
    // Simulation d'update - à remplacer par une vraie API
    // waitingCountElement.textContent = newCount;
}

// Appeler un ticket
>>>>>>> origin/amina
document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('call-ticket')){
        let ticketId = e.target.dataset.id;
        let serviceId = e.target.dataset.service;
<<<<<<< HEAD
=======
        
        // Animation de confirmation
        e.target.innerHTML = '<i class="fas fa-spinner animate-spin"></i>';
        e.target.disabled = true;
        
>>>>>>> origin/amina
        fetch(`/admin/tickets/${ticketId}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({status: 'appele'})
<<<<<<< HEAD
        }).then(() => refreshQueue(serviceId));
=======
        })
        .then(response => {
            if(response.ok) {
                // Animation de succès
                e.target.innerHTML = '<i class="fas fa-check"></i> Appelé';
                e.target.classList.remove('bg-medical-blue');
                e.target.classList.add('bg-green-500');
                
                // Rafraîchir la file après un court délai
                setTimeout(() => refreshQueue(serviceId), 1000);
            }
        })
        .catch(error => {
            console.error('Error calling ticket:', error);
            e.target.innerHTML = 'Erreur';
            e.target.classList.remove('bg-medical-blue');
            e.target.classList.add('bg-red-500');
        });
    }
    
    // Bouton "Appeler suivant"
    if(e.target && e.target.classList.contains('call-next-ticket')){
        let serviceId = e.target.dataset.service;
        let nextTicket = document.querySelector(`#queue-${serviceId} .call-ticket`);
        
        if(nextTicket) {
            nextTicket.click();
        } else {
            // Aucun ticket en attente
            e.target.innerHTML = 'File vide';
            e.target.disabled = true;
            setTimeout(() => {
                e.target.innerHTML = 'Appeler suivant';
                e.target.disabled = false;
            }, 2000);
        }
>>>>>>> origin/amina
    }
});

// Rafraîchissement automatique toutes les 5 secondes
<<<<<<< HEAD


</script>
@endsection
=======
setInterval(() => {
    @foreach($services as $service)
        refreshQueue({{ $service->id }});
    @endforeach
    
    // Mettre à jour l'heure
    document.querySelectorAll('.text-2xl.font-bold').forEach(el => {
        if(el.textContent.includes(':')) {
            el.textContent = new Date().toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit'});
        }
    });
}, 5000);

// Animation d'entrée
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection
>>>>>>> origin/amina
