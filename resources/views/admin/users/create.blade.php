@extends('admin.layout')

@section('title', 'Ajouter un patient')
@section('page-title', 'Ajouter un patient')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Ajouter un nouveau patient</h1>
                    <p class="mt-2 text-gray-600">Créez un compte patient pour votre établissement</p>
                </div>
                <a href="{{ route('admin.patients.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h2 class="text-lg font-semibold text-gray-800">Informations du patient</h2>
                <p class="text-sm text-gray-600 mt-1">Renseignez les informations nécessaires pour créer le compte</p>
            </div>
            
            <div class="p-6">
                <form action="{{ route('admin.patients.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Nom -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-user text-blue-500 mr-2"></i>Nom complet
                        </label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}" 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Entrez le nom complet">
                        </div>
                        @error('name') 
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-2"></i>Adresse email
                        </label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email') }}" 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Entrez l'adresse email">
                        </div>
                        @error('email') 
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-lock text-blue-500 mr-2"></i>Mot de passe
                        </label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Entrez le mot de passe">
                        </div>
                        @error('password') 
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-lock text-blue-500 mr-2"></i>Confirmer le mot de passe
                        </label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Confirmez le mot de passe">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.patients.index') }}" 
                           class="inline-flex items-center px-5 py-2.5 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-sm">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md">
                            <i class="fas fa-user-plus mr-2"></i>Ajouter le patient
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Information -->
        <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-lg mt-0.5"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Information importante</h3>
                    <div class="mt-1 text-sm text-blue-700">
                        <p>Le patient recevra un email avec ses informations de connexion.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection