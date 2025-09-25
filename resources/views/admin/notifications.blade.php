@extends('admin.layout')

@section('title', 'Envoyer une Notification')

@section('page-title', 'Envoyer une Notification')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-gradient-to-r from-medical-blue to-medical-teal rounded-xl flex items-center justify-center">
                <i class="fas fa-bell text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Envoyer une Notification</h1>
                <p class="text-gray-600">Envoyez une notification à un patient spécifique</p>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- En-tête du formulaire -->
        <div class="bg-gradient-to-r from-gray-50 to-white p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Détails de la notification</h2>
            <p class="text-gray-600 text-sm">Complétez les informations pour envoyer une notification</p>
        </div>

        <form action="{{ route('notifications.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Sélectionner un patient -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2 text-medical-blue"></i> Sélectionner un patient
                </label>
                <div class="relative">
                    <select name="user_id" id="user_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12">
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-users text-gray-400"></i>
                    </div>
                </div>
                @error('user_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Titre -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag mr-2 text-medical-blue"></i> Titre *
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="title" 
                        id="title"
                        value="{{ old('title') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12"
                        placeholder="Entrez le titre de la notification"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-heading text-gray-400"></i>
                    </div>
                </div>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-2 text-medical-blue"></i> Message
                </label>
                <div class="relative">
                    <textarea 
                        name="message" 
                        id="message" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300 pl-12 resize-none"
                        placeholder="Écrivez le contenu de la notification"
                    >{{ old('message') }}</textarea>
                    <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                        <i class="fas fa-file-alt text-gray-400"></i>
                    </div>
                </div>
                @error('message')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="flex justify-between items-center mt-1">
                    <p class="text-xs text-gray-500">Le message peut être personnalisé</p>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-4">
                    <button type="reset" 
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300">
                        <i class="fas fa-redo mr-2"></i>Réinitialiser
                    </button>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-medical-blue to-medical-teal text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>Envoyer la notification</span>
                    </button>
                </div>
            </div>
        </form>
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
@endsection
