@extends('patient.layout')

@section('title', 'Suivre mon rang')
@section('page-title', 'Suivre mon rang')

@section('content')
<div class="space-y-8">
    <!-- En-tête principale -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Suivi en temps réel</h1>
                <p class="text-blue-100 text-lg">Votre position dans les files d'attente</p>
            </div>
            <div class="text-5xl">👁️</div>
        </div>
    </div>

    <!-- Cartes des services -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($services as $service)
            @php
                $ticket = $tickets->firstWhere('service_id', $service->id);
                $restants = $ticket ? ($positions[$service->id] ?? 0) : null;
                $isNext = $restants === 0;
                $isSoon = $restants && $restants <= 3;
            @endphp

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl 
                {{ $isNext ? 'ring-2 ring-green-500 transform -translate-y-1' : '' }}
                {{ $isSoon ? 'ring-2 ring-yellow-500' : '' }}">
                
                <!-- En-tête de la carte -->
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-stethoscope text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $service->name }}</h2>
                        <p class="text-gray-500 text-sm">Service médical</p>
                    </div>
                </div>

                <!-- Contenu -->
                @if($ticket)
                    <div class="text-center py-4">
                        @if($isNext)
                            <!-- C'est votre tour -->
                            <div class="animate-pulse mb-4">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-check text-green-600 text-2xl"></i>
                                </div>
                                <p class="text-green-600 font-bold text-lg">C'est votre tour !</p>
                            </div>
                            <p class="text-gray-700 mb-4">Présentez-vous au service</p>
                        @else
                            <!-- Encore des personnes avant -->
                            <div class="mb-4">
                                <div class="text-4xl font-bold text-blue-600">{{ $restants }}</div>
                                <p class="text-gray-600">personne(s) avant vous</p>
                            </div>
                            
                            <!-- Barre de progression -->
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-1000" 
                                     style="width: {{ max(10, 100 - ($restants * 10)) }}%"></div>
                            </div>
                        @endif

                        <!-- Informations du ticket -->
                        <div class="bg-gray-50 rounded-lg p-3 mt-4">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Votre ticket :</span>
                                <span class="font-mono font-bold">#{{ $ticket->id }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 mt-1">
                                <span>Arrivé à :</span>
                                <span>{{ $ticket->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Alertes -->
                    @if($isNext)
                        <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-exclamation-circle text-green-500"></i>
                                <span class="text-green-700 font-medium">Rendez-vous immédiatement au service</span>
                            </div>
                        </div>
                    @elseif($isSoon)
                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock text-yellow-500"></i>
                                <span class="text-yellow-700 font-medium">Préparez-vous, c'est bientôt votre tour</span>
                            </div>
                        </div>
                    @endif

                @else
                    <!-- Aucun ticket -->
                    <div class="text-center py-6">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-plus text-gray-400 text-xl"></i>
                        </div>
                        <p class="text-gray-500 mb-4">Vous n'avez pas de ticket actif</p>
                        <a href="{{ route('patient.reserve') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-ticket mr-2"></i>
                            Réserver un ticket
                        </a>
                    </div>
                @endif

                <!-- Pied de carte -->
                <div class="mt-4 pt-3 border-t border-gray-100">
                    <p class="text-xs text-gray-400 text-center">
                        Mis à jour à {{ now()->format('H:i') }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Information supplémentaire -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-center space-x-3">
            <i class="fas fa-info-circle text-blue-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-blue-800">Comment suivre votre rang ?</h4>
                <p class="text-blue-600 text-sm mt-1">
                    Votre position est mise à jour automatiquement. Lorsque le compteur atteint 0, 
                    présentez-vous au service concerné avec votre pièce d'identité.
                </p>
            </div>
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
</style>

<script>
    // Animation d'entrée pour les cartes
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            card.style.transform = 'translateY(20px)';
            card.style.opacity = '0';
            
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease-out';
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
            }, index * 150);
        });

        // Mise à jour automatique toutes les 30 secondes
        setInterval(() => {
            const timeElements = document.querySelectorAll('.text-xs.text-gray-400');
            timeElements.forEach(el => {
                el.textContent = 'Mis à jour à ' + new Date().toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit'});
            });
        }, 30000);
    });
</script>
@endsection