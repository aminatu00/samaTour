@extends('patient.layout')

@section('title', 'Mes Tickets')
@section('page-title', 'Mes Tickets')

@section('content')
<div class="space-y-6">
    <!-- En-tête avec statistiques -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-6 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Historique de vos tickets</h1>
                <p class="text-blue-100">Retrouvez tous vos tickets passés et en cours</p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold">{{ $tickets->count() }}</div>
                <div class="text-blue-100 text-sm">Tickets au total</div>
            </div>
        </div>
    </div>

    <!-- Filtres et statistiques rapides -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-blue-600">{{ $tickets->where('status', 'en_attente')->count() }}</div>
                    <div class="text-gray-600 text-sm">En attente</div>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-blue-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-green-600">{{ $tickets->where('status', 'appele')->count() }}</div>
                    <div class="text-gray-600 text-sm">En cours</div>
                </div>
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-md text-green-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-600">{{ $tickets->where('status', 'termine')->count() }}</div>
                    <div class="text-gray-600 text-sm">Terminés</div>
                </div>
                <div class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-gray-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-red-600">{{ $tickets->where('category', 'urgent')->count() }}</div>
                    <div class="text-gray-600 text-sm">Urgents</div>
                </div>
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des tickets -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Tous vos tickets</h2>
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <i class="fas fa-sort"></i>
                    <span>Trier par : Date récente</span>
                </div>
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($tickets as $ticket)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Ticket #{{ $ticket->numero_ticket }}</h3>
                                <p class="text-gray-600 text-sm">{{ $ticket->service->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($ticket->status === 'en_attente') bg-blue-100 text-blue-800
                                @elseif($ticket->status === 'appele') bg-green-100 text-green-800
                                @elseif($ticket->status === 'termine') bg-gray-100 text-gray-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </div>
                            <div class="mt-1 text-xs text-gray-500">
                                {{ $ticket->created_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="flex items-center space-x-2 text-gray-600">
                            <i class="fas fa-tag w-4 text-center"></i>
                            <span class="text-sm">Catégorie :</span>
                            <span class="font-medium capitalize 
                                @if($ticket->category === 'urgent') text-red-600 @else text-gray-800 @endif">
                                {{ $ticket->category }}
                                @if($ticket->category === 'urgent') <i class="fas fa-bolt ml-1"></i> @endif
                            </span>
                        </div>

                        <div class="flex items-center space-x-2 text-gray-600">
                            <i class="fas fa-hospital w-4 text-center"></i>
                            <span class="text-sm">Service :</span>
                            <span class="font-medium text-gray-800">{{ $ticket->service->name ?? 'N/A' }}</span>
                        </div>

                        <div class="flex items-center space-x-2 text-gray-600">
                            <i class="fas fa-clock w-4 text-center"></i>
                            <span class="text-sm">Durée :</span>
                            <span class="font-medium text-gray-800">
                                {{ $ticket->created_at->diffForHumans(null, true) }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle"></i>
                            <span>
                                @if($ticket->status === 'en_attente')
                                    En attente de traitement
                                @elseif($ticket->status === 'appele')
                                    En cours de consultation
                                @elseif($ticket->status === 'termine')
                                    Consultation terminée
                                @endif
                            </span>
                        </div>

                        <div class="flex items-center space-x-2">
                            @if($ticket->status === 'en_attente')
                                <a href="{{ route('patient.suivre') }}" 
                                   class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-eye mr-1"></i> Suivre
                                </a>
                            @endif
                            
                            <button class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition-colors">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-ticket-alt text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">Aucun ticket trouvé</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas encore créé de ticket</p>
                    <a href="{{ route('patient.reserve') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i> Réserver un ticket
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($tickets->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Affichage de {{ $tickets->firstItem() }} à {{ $tickets->lastItem() }} sur {{ $tickets->total() }} tickets
                </div>
                <div class="flex space-x-2">
                    @if($tickets->onFirstPage())
                        <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $tickets->previousPageUrl() }}" class="px-3 py-1 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @if($tickets->hasMorePages())
                        <a href="{{ $tickets->nextPageUrl() }}" class="px-3 py-1 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Information supplémentaire -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-center space-x-3">
            <i class="fas fa-info-circle text-blue-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-blue-800">Comment fonctionnent vos tickets ?</h4>
                <p class="text-blue-600 text-sm mt-1">
                    Vos tickets sont classés par date de création. Vous pouvez suivre l'avancement de chaque ticket 
                    et recevoir des notifications lorsque c'est votre tour.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'entrée pour les éléments
        const items = document.querySelectorAll('.divide-y > div');
        items.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                item.style.transition = 'all 0.5s ease-out';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Mise à jour en temps réel des statuts (simulation)
        setInterval(() => {
            document.querySelectorAll('[class*="bg-blue-100"]').forEach(badge => {
                // Simulation de mise à jour de statut
                if (badge.textContent.includes('en attente') && Math.random() > 0.95) {
                    badge.className = badge.className.replace('bg-blue-100 text-blue-800', 'bg-green-100 text-green-800');
                    badge.textContent = 'Appelé';
                }
            });
        }, 10000);
    });
</script>
@endsection