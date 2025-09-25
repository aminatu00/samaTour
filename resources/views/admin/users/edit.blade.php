@extends('admin.layout')

@section('title', 'Modifier un patient')
<<<<<<< HEAD

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Modifier le patient</h1>

    <form action="{{ route('admin.patients.update', $patient) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold mb-1">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" class="w-full border rounded p-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" class="w-full border rounded p-2">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block font-semibold mb-1">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="password" id="password" class="w-full border rounded p-2">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block font-semibold mb-1">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Mettre à jour</button>
        <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Retour</a>
    </form>
</div>
@endsection
=======
@section('page-title', 'Modifier un patient')

@section('content')
<div class="max-w-md mx-auto">
    <!-- Carte du formulaire -->
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-edit text-blue-600"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-800">Modifier le patient</h1>
        </div>

        <form action="{{ route('admin.patients.update', $patient) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name') 
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('email') 
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center space-x-2 mb-2">
                    <i class="fas fa-key text-gray-400"></i>
                    <label class="text-sm font-medium text-gray-700">Mot de passe</label>
                </div>
                <p class="text-xs text-gray-500 mb-3">Laisser vide pour ne pas modifier</p>
                
                <div class="space-y-3">
                    <div>
                        <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('password') 
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                        @enderror
                    </div>
                    
                    <div>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex space-x-3 pt-4">
                <button type="submit" 
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    <i class="fas fa-save mr-2"></i>Mettre à jour
                </button>
                <a href="{{ route('admin.patients.index') }}" 
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    <!-- Informations patient -->
    <div class="bg-blue-50 rounded-lg p-4 mt-4">
        <div class="flex items-center space-x-2">
            <i class="fas fa-info-circle text-blue-500"></i>
            <span class="text-sm text-blue-700">
                Patient créé le {{ $patient->created_at->format('d/m/Y') }}
            </span>
        </div>
    </div>
</div>

<style>
    input:focus {
        outline: none;
        ring: 2px;
    }
</style>

<script>
    // Animation simple d'entrée
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.bg-white');
        form.style.transform = 'translateY(10px)';
        form.style.opacity = '0';
        
        setTimeout(() => {
            form.style.transition = 'all 0.3s ease-out';
            form.style.transform = 'translateY(0)';
            form.style.opacity = '1';
        }, 100);
    });
</script>
@endsection
>>>>>>> origin/amina
