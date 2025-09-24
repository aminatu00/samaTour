@extends('admin.layout')

@section('title', 'Créer un service')
@section('page-title', 'Créer un nouveau service')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-gradient-to-r from-medical-blue to-medical-teal rounded-xl flex items-center justify-center">
                <i class="fas fa-plus text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Créer un nouveau service</h1>
                <p class="text-gray-600">Ajoutez un nouveau service médical à votre établissement</p>
            </div>
        </div>
        
        <!-- Breadcrumb -->
        <nav class="flex space-x-2 text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-medical-blue transition-colors">Tableau de bord</a>
            <span>></span>
            <a href="{{ route('admin.services') }}" class="hover:text-medical-blue transition-colors">Services</a>
            <span>></span>
            <span class="text-medical-blue font-medium">Nouveau service</span>
        </nav>
    </div>

    <!-- Formulaire -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- En-tête du formulaire -->
        <div class="bg-gradient-to-r from-gray-50 to-white p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Informations du service</h2>
            <p class="text-gray-600 text-sm">Remplissez les détails du nouveau service médical</p>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

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
                        value="{{ old('name') }}"
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
                <p class="mt-1 text-xs text-gray-500">Le nom doit être clair et identifiable par les patients</p>
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
                    >{{ old('description') }}</textarea>
                    <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                        <i class="fas fa-file-alt text-gray-400"></i>
                    </div>
                </div>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="flex justify-between items-center mt-1">
                    <p class="text-xs text-gray-500">Description facultative mais recommandée</p>
                    <span id="description-counter" class="text-xs text-gray-500">0/500</span>
                </div>
            </div>

            <!-- Type de service -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-list-alt mr-2 text-medical-blue"></i>Type de service
                </label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <label class="relative">
                        <input type="radio" name="type" value="consultation" class="sr-only peer" checked>
                        <div class="p-4 border-2 border-gray-200 rounded-xl text-center cursor-pointer transition-all duration-300 peer-checked:border-medical-blue peer-checked:bg-blue-50 hover:border-gray-300">
                            <i class="fas fa-stethoscope text-gray-400 text-xl mb-2"></i>
                            <div class="font-medium text-gray-800">Consultation</div>
                        </div>
                    </label>
                    
                    <label class="relative">
                        <input type="radio" name="type" value="urgence" class="sr-only peer">
                        <div class="p-4 border-2 border-gray-200 rounded-xl text-center cursor-pointer transition-all duration-300 peer-checked:border-medical-blue peer-checked:bg-blue-50 hover:border-gray-300">
                            <i class="fas fa-ambulance text-gray-400 text-xl mb-2"></i>
                            <div class="font-medium text-gray-800">Urgence</div>
                        </div>
                    </label>
                    
                    <label class="relative">
                        <input type="radio" name="type" value="examen" class="sr-only peer">
                        <div class="p-4 border-2 border-gray-200 rounded-xl text-center cursor-pointer transition-all duration-300 peer-checked:border-medical-blue peer-checked:bg-blue-50 hover:border-gray-300">
                            <i class="fas fa-microscope text-gray-400 text-xl mb-2"></i>
                            <div class="font-medium text-gray-800">Examen</div>
                        </div>
                    </label>
                    
                    <label class="relative">
                        <input type="radio" name="type" value="autre" class="sr-only peer">
                        <div class="p-4 border-2 border-gray-200 rounded-xl text-center cursor-pointer transition-all duration-300 peer-checked:border-medical-blue peer-checked:bg-blue-50 hover:border-gray-300">
                            <i class="fas fa-ellipsis-h text-gray-400 text-xl mb-2"></i>
                            <div class="font-medium text-gray-800">Autre</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Statut -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-power-off mr-2 text-medical-blue"></i>Statut du service
                </label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="status" value="actif" class="text-medical-blue focus:ring-medical-blue" checked>
                        <span class="text-gray-700">Actif</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="status" value="inactif" class="text-medical-blue focus:ring-medical-blue">
                        <span class="text-gray-700">Inactif</span>
                    </label>
                </div>
                <p class="mt-1 text-xs text-gray-500">Un service inactif n'apparaîtra pas dans les options de réservation</p>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.services') }}" 
                   class="flex items-center space-x-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour à la liste</span>
                </a>
                
                <div class="flex items-center space-x-4">
                    <button type="reset" 
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300">
                        <i class="fas fa-redo mr-2"></i>Réinitialiser
                    </button>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-medical-blue to-medical-teal text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-plus-circle"></i>
                        <span>Créer le service</span>
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
                <h3 class="font-semibold text-blue-800">Conseils pour nommer un service</h3>
            </div>
            <ul class="text-blue-700 text-sm space-y-2">
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-blue-500 text-xs"></i>
                    <span>Utilisez un nom clair et compréhensible</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-blue-500 text-xs"></i>
                    <span>Évitez les acronymes peu connus</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-blue-500 text-xs"></i>
                    <span>Respectez la nomenclature médicale standard</span>
                </li>
            </ul>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-2xl p-6">
            <div class="flex items-center space-x-3 mb-3">
                <i class="fas fa-clock text-green-500 text-xl"></i>
                <h3 class="font-semibold text-green-800">Après la création</h3>
            </div>
            <ul class="text-green-700 text-sm space-y-2">
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-green-500 text-xs"></i>
                    <span>Le service sera immédiatement disponible</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-green-500 text-xs"></i>
                    <span>Les patients pourront réserver des tickets</span>
                </li>
                <li class="flex items-center space-x-2">
                    <i class="fas fa-check text-green-500 text-xs"></i>
                    <span>Vous pourrez modifier les paramètres plus tard</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    input:focus, textarea:focus {
        outline: none;
        ring: 2px;
    }
    
    .peer-checked .fa-stethoscope,
    .peer-checked .fa-ambulance,
    .peer-checked .fa-microscope,
    .peer-checked .fa-ellipsis-h {
        color: #2563eb;
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
        
        // Validation en temps réel du nom
        const nameInput = document.getElementById('name');
        nameInput.addEventListener('blur', function() {
            if (this.value.length < 2) {
                this.classList.add('border-red-300');
            } else {
                this.classList.remove('border-red-300');
            }
        });
    });
</script>
@endsection