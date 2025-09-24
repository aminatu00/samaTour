@extends('admin.layout')

@section('title', 'Gestion des services')
@section('page-title', 'Gestion des services')

@section('content')
<div class="space-y-6">
    <!-- En-tête avec statistiques -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-6 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Gestion des services médicaux</h1>
                <p class="text-blue-100">Créez et gérez les services disponibles pour les patients</p>
            </div>
            <div class="text-right">
              <div class="text-3xl font-bold">{{ $services->sum('tickets_today_count') }}</div>
<div class="text-blue-100 text-sm">Tickets aujourd'hui</div>

            </div>
        </div>
    </div>

    <!-- Carte d'actions principales -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Liste des services</h2>
            <a href="{{ route('admin.services.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-plus-circle mr-2"></i>
                Nouveau service
            </a>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center space-x-3 animate-fade-in">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
                <div>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Grid des services -->
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="bg-gray-50 rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-300">
                        <!-- En-tête de la carte -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white">
                                    <i class="fas fa-hospital"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">{{ $service->name }}</h3>
                            </div>
                            <div class="relative">
                                <button class="service-menu-btn p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="service-menu hidden absolute right-0 top-full mt-1 w-32 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-10">
                                    <a href="{{ route('admin.services.edit', $service) }}" 
                                       class="flex items-center space-x-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        <i class="fas fa-edit w-4 text-center"></i>
                                        <span>Modifier</span>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="confirmDelete('{{ $service->name }}', this.form)"
                                                class="w-full flex items-center space-x-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <i class="fas fa-trash w-4 text-center"></i>
                                            <span>Supprimer</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $service->description ?? 'Aucune description fournie' }}
                            </p>
                        </div>

                        <!-- Métriques -->
                        <div class="grid grid-cols-2 gap-3 text-center">
                            <div class="bg-white rounded-lg p-2">
<div class="text-lg font-bold text-blue-600">{{ $service->tickets_today_count }}</div>
                                <div class="text-xs text-gray-500">Tickets aujourd'hui</div>
                            </div>
                            <div class="bg-white rounded-lg p-2">
                                <div class="text-lg font-bold text-green-600">8min</div>
                                <div class="text-xs text-gray-500">Temps moyen</div>
                            </div>
                        </div>

                        <!-- Pied de carte -->
                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>Créé le {{ $service->created_at->format('d/m/Y') }}</span>
                                <span class="flex items-center space-x-1">
                                    <i class="fas fa-circle text-green-500 text-xs"></i>
                                    <span>Actif</span>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- État vide -->
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hospital text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Aucun service créé</h3>
                <p class="text-gray-500 mb-6">Commencez par créer votre premier service médical</p>
                <a href="{{ route('admin.services.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Créer un service
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if($services->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Affichage de {{ $services->firstItem() }} à {{ $services->lastItem() }} sur {{ $services->total() }} services
                </div>
                <div class="flex space-x-2">
                    @if($services->onFirstPage())
                        <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $services->previousPageUrl() }}" class="px-3 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @if($services->hasMorePages())
                        <a href="{{ $services->nextPageUrl() }}" class="px-3 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Informations supplémentaires -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-center space-x-3">
            <i class="fas fa-info-circle text-blue-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-blue-800">Gestion des services</h4>
                <p class="text-blue-600 text-sm mt-1">
                    Chaque service représente un département médical. Les patients peuvent réserver des tickets 
                    pour ces services et suivre leur rang en temps réel.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md mx-4">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-500"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Confirmer la suppression</h3>
                <p class="text-gray-600 text-sm" id="deleteMessage">Êtes-vous sûr de vouloir supprimer ce service ?</p>
            </div>
        </div>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                Annuler
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.service-menu {
    animation: slideDown 0.2s ease-out;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
function confirmDelete(serviceName, form) {
    document.getElementById('deleteMessage').textContent = 
        `Êtes-vous sûr de vouloir supprimer le service "${serviceName}" ? Cette action est irréversible.`;
    document.getElementById('deleteForm').action = form.action;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    // Gestion des menus déroulants
    document.querySelectorAll('.service-menu-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            const isOpen = !menu.classList.contains('hidden');
            
            // Fermer tous les autres menus
            document.querySelectorAll('.service-menu').forEach(m => {
                m.classList.add('hidden');
            });
            
            // Ouvrir/fermer le menu actuel
            if (isOpen) {
                menu.classList.add('hidden');
            } else {
                menu.classList.remove('hidden');
            }
        });
    });

    // Fermer les menus en cliquant ailleurs
    document.addEventListener('click', function() {
        document.querySelectorAll('.service-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    });

    // Animation d'entrée pour les cartes
    const cards = document.querySelectorAll('.bg-gray-50');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection