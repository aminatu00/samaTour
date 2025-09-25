@extends('admin.layout')

@section('title', 'Modifier un service')
<<<<<<< HEAD

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Modifier le service</h1>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold">Nom du service</label>
            <input type="text" name="name" id="name" 
                   value="{{ $service->name }}" 
                   class="border rounded p-2 w-full" required>
        </div>

        <div>
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" 
                      class="border rounded p-2 w-full">{{ $service->description }}</textarea>
        </div>

        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Mettre à jour
        </button>
        <a href="{{ route('admin.services') }}" class="ml-2 text-gray-600">Annuler</a>
    </form>
</div>
@endsection
=======
@section('page-title', 'Modifier le service')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-gradient-to-r from-medical-teal to-medical-green rounded-xl flex items-center justify-center">
                <i class="fas fa-edit text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Modifier le service</h1>
                <p class="text-gray-600">Mettez à jour les informations du service médical</p>
            </div>
        </div>
        
        <!-- Breadcrumb -->
        <nav class="flex space-x-2 text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-medical-blue transition-colors">Tableau de bord</a>
            <span>></span>
            <a href="{{ route('admin.services') }}" class="hover:text-medical-blue transition-colors">Services</a>
            <span>></span>
            <span class="text-medical-blue font-medium">Modifier {{ $service->name }}</span>
        </nav>
    </div>

    <!-- Formulaire -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- En-tête du formulaire -->
        <div class="bg-gradient-to-r from-gray-50 to-white p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Modification du service</h2>
                    <p class="text-gray-600 text-sm">Mettez à jour les informations de {{ $service->name }}</p>
                </div>
                <div class="flex items-center space-x-2 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    <i class="fas fa-info-circle"></i>
                    <span>Créé le {{ $service->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Nom du service -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag mr-2 text-medical-blue"></i>Nom du service *
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $service->name) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                        placeholder="Ex: Cardiologie, Urgences, Pédiatrie..."
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-hospital text-gray-400"></i>
                    </div>
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-2 text-medical-blue"></i>Description
                </label>
                <div class="relative">
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12 resize-none"
                        placeholder="Décrivez brièvement ce service..."
                    >{{ old('description', $service->description) }}</textarea>
                    <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                        <i class="fas fa-file-alt text-gray-400"></i>
                    </div>
                </div>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="flex justify-between items-center mt-1">
                    <p class="text-xs text-gray-500">Description facultative mais recommandée</p>
                    <span id="description-counter" class="text-xs text-gray-500">{{ strlen(old('description', $service->description)) }}/500</span>
                </div>
            </div>

            <!-- Statut -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-power-off mr-2 text-medical-blue"></i>Statut du service
                </label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="status" value="actif" 
                               class="text-medical-blue focus:ring-medical-blue" 
                               {{ old('status', $service->status) === 'actif' ? 'checked' : '' }}>
                        <span class="text-gray-700">Actif</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="status" value="inactif" 
                               class="text-medical-blue focus:ring-medical-blue"
                               {{ old('status', $service->status) === 'inactif' ? 'checked' : '' }}>
                        <span class="text-gray-700">Inactif</span>
                    </label>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    @if($service->status === 'actif')
                        <span class="text-green-600">✓ Ce service est actuellement actif et visible par les patients</span>
                    @else
                        <span class="text-red-600">✗ Ce service est actuellement inactif et caché des patients</span>
                    @endif
                </p>
            </div>

            <!-- Statistiques du service -->
            <div class="bg-gray-50 rounded-xl p-4">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-chart-bar mr-2 text-medical-blue"></i>Statistiques du service
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-800">{{ $service->tickets()->count() }}</div>
                        <div class="text-xs text-gray-600">Tickets total</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-800">{{ $service->tickets()->where('status', 'en_attente')->count() }}</div>
                        <div class="text-xs text-gray-600">En attente</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-800">{{ $service->tickets()->where('status', 'termine')->count() }}</div>
                        <div class="text-xs text-gray-600">Terminés</div>
                    </div>
                    <div class="text-center">
                        @php
    $avgTime = $service->tickets()
        ->where('status', 'termine')
        ->get()
        ->map(function ($ticket) {
            return $ticket->updated_at->diffInMinutes($ticket->created_at);
        })
        ->avg();
@endphp
<div class="text-lg font-bold text-gray-800">
    {{ $avgTime ? round($avgTime) . ' min' : 'N/A' }}
</div>

                        <div class="text-xs text-gray-600">Temps moyen</div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.services') }}" 
                       class="flex items-center space-x-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300">
                        <i class="fas fa-arrow-left"></i>
                        <span>Retour à la liste</span>
                    </a>
                    
                    <button type="button" 
                            onclick="confirmDelete()"
                            class="flex items-center space-x-2 px-6 py-3 border border-red-300 text-red-700 rounded-xl hover:bg-red-50 transition-all duration-300">
                        <i class="fas fa-trash"></i>
                        <span>Supprimer</span>
                    </button>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button type="reset" 
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300">
                        <i class="fas fa-redo mr-2"></i>Réinitialiser
                    </button>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-medical-teal to-medical-green text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-save"></i>
                        <span>Mettre à jour</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Informations supplémentaires -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
            <div class="flex items-center space-x-3 mb-3">
                <i class="fas fa-lightbulb text-blue-500 text-xl"></i>
                <h3 class="font-semibold text-blue-800">Conseils de modification</h3>
            </div>
            <ul class="text-blue-700 text-sm space-y-2">
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-blue-500 text-xs"></i>
                    <span>Vérifiez l'orthographe du nom du service</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-blue-500 text-xs"></i>
                    <span>Une description claire aide les patients</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-blue-500 text-xs"></i>
                    <span>Désactivez temporairement si nécessaire</span>
                </li>
            </ul>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6">
            <div class="flex items-center space-x-3 mb-3">
                <i class="fas fa-exclamation-triangle text-amber-500 text-xl"></i>
                <h3 class="font-semibold text-amber-800">Attention</h3>
            </div>
            <ul class="text-amber-700 text-sm space-y-2">
                <li class="flex items-center space-x-2">
                    <i class="fas fa-info-circle text-amber-500 text-xs"></i>
                    <span>Les modifications sont immédiates</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-info-circle text-amber-500 text-xs"></i>
                    <span>Les tickets en cours ne sont pas affectés</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-info-circle text-amber-500 text-xs"></i>
                    <span>La suppression est définitive</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md mx-4">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Supprimer le service</h3>
                <p class="text-gray-600 text-sm">Cette action est irréversible</p>
            </div>
        </div>
        
        <p class="text-gray-700 mb-6">
            Êtes-vous sûr de vouloir supprimer le service <strong>"{{ $service->name }}"</strong> ? 
            Cette action supprimera également tous les tickets associés.
        </p>
        
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Annuler
            </button>
            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash mr-2"></i>Supprimer définitivement
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    input:focus, textarea:focus {
        outline: none;
        ring: 2px;
    }
    
    #deleteModal {
        backdrop-filter: blur(5px);
    }
</style>

<script>
    // Compteur de caractères pour la description
    document.addEventListener('DOMContentLoaded', function() {
        const descriptionTextarea = document.getElementById('description');
        const counter = document.getElementById('description-counter');
        
        descriptionTextarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = `${length}/500`;
            
            if (length > 450) {
                counter.classList.add('text-yellow-600');
                counter.classList.remove('text-gray-500');
            } else if (length > 500) {
                counter.classList.add('text-red-600');
                counter.classList.remove('text-yellow-600');
            } else {
                counter.classList.remove('text-yellow-600', 'text-red-600');
                counter.classList.add('text-gray-500');
            }
        });
        
        // Animation d'entrée
        const formElements = document.querySelectorAll('input, textarea, button, label, .bg-white');
        formElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                el.style.transition = 'all 0.5s ease-out';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 50);
        });
    });
    
    // Gestion de la modal de suppression
    function confirmDelete() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    
    // Fermer la modal en cliquant à l'extérieur
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    
    // Fermer la modal avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endsection
>>>>>>> origin/amina
