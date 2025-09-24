@extends('patient.layout')

@section('title', 'Suivre mon rang')
@section('page-title', 'Suivre mon rang')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($services as $service)
        @php
            $ticket = $tickets->firstWhere('service_id', $service->id);
            $restants = $ticket ? ($positions[$service->id] ?? 0) : null;
        @endphp
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-bold mb-4">{{ $service->name }}</h2>
            @if($ticket)
                <p class="text-gray-700">
                    Plus que <span class="font-bold">{{ $restants }}</span> personne(s) avant vous.
                </p>
                @if($restants === 0)
                    <p class="text-green-600 font-bold mt-2">⚡ C'est votre tour ! Rendez-vous au service.</p>
                @endif
            @else
                <p class="text-gray-500 italic">Vous n'avez aucun ticket dans ce service.</p>
            @endif
        </div>
    @endforeach
</div>
@endsection
