@extends('patient.layout')

@section('title', 'Dashboard')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-6 shadow rounded-lg">
        <h2 class="text-xl font-semibold">Mes tickets</h2>
        <p class="text-gray-600">Voir vos tickets en attente ou terminés.</p>
    </div>
    <div class="bg-white p-6 shadow rounded-lg">
        <h2 class="text-xl font-semibold">Réserver un ticket</h2>
        <p class="text-gray-600">Réservez un ticket rapidement pour votre visite.</p>
    </div>
    <div class="bg-white p-6 shadow rounded-lg">
        <h2 class="text-xl font-semibold">Notifications</h2>
        <p class="text-gray-600">Toutes vos notifications récentes.</p>
    </div>
</div>
@endsection
