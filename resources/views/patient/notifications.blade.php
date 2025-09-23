@extends('patient.layout')

@section('title', 'Notifications')

@section('page-title', 'Mes Notifications')

@section('content')
<div class="space-y-4">
    @if($notifications->isEmpty())
        <div class="bg-white p-6 shadow rounded-lg">
            <p class="text-gray-600">Vous n'avez aucune notification pour l'instant.</p>
        </div>
    @else
        @foreach($notifications as $notif)
            <div class="bg-white p-4 rounded-lg shadow hover:bg-gray-50 transition">
                <h3 class="font-semibold text-lg text-gray-800">{{ $notif->title }}</h3>
                <p class="text-gray-700 mt-1">{{ $notif->message }}</p>
                <span class="text-xs text-gray-400 mt-2 block">
                    {{ $notif->created_at->format('d/m/Y H:i') }}
                </span>
            </div>
        @endforeach
    @endif
</div>
@endsection
