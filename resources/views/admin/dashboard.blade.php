@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('page-title', 'Tableau de bord')

@section('content')
    <div class="grid grid-cols-3 gap-6 mt-4">
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold">Utilisateurs</h3>
            <p class="text-gray-600">Nombre total d’utilisateurs inscrits.</p>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold">Tickets</h3>
            <p class="text-gray-600">Suivi des réservations en cours.</p>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold">Notifications</h3>
            <p class="text-gray-600">Derniers messages envoyés.</p>
        </div>
    </div>
@endsection
