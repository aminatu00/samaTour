@extends('patient.layout')

@section('title', 'Dashboard')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-8">
    <!-- Bannière de bienvenue -->
    <div class="bg-gradient-to-r from-medical-blue to-medical-teal rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Bonjour, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-blue-100 text-lg">Votre suivi médical simplifié et efficace</p>
            </div>
            <div class="text-5xl animate-float">🏥</div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-medical-blue"></i>
                </div>
                <span class="text-3xl font-bold text-gray-800">2</span>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">En attente</h3>
            <p class="text-gray-600 text-sm">Tickets en cours de traitement</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-medical-green"></i>
                </div>
                <span class="text-3xl font-bold text-gray-800">5</span>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Terminés</h3>
            <p class="text-gray-600 text-sm">Consultations effectuées</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-star text-2xl text-purple-500"></i>
                </div>
                <span class="text-3xl font-bold text-gray-800">12</span>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Jours</h3>
            <p class="text-gray-600 text-sm">D'utilisation du service</p>
        </div>
    </div>

    <!-- Actions principales -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <a href="{{ route('patient.reserve') }}" class="group">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group-hover:border-medical-blue/30">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-medical-blue to-medical-teal rounded-xl flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 text-lg">Nouvelle réservation</h3>
                        <p class="text-gray-600">Prenez un ticket pour votre consultation</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-medical-blue group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('patient.suivre') }}" class="group">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group-hover:border-medical-blue/30">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-medical-green to-emerald-400 rounded-xl flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 text-lg">Suivre mon rang</h3>
                        <p class="text-gray-600">Vérifiez votre position en temps réel</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-medical-blue group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection