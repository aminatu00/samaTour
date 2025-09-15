@extends('patient.layout')

@section('title', 'Rangs pour '.$service->name)

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Rangs pour le service {{ $service->name }} ({{ $category }})</h2>

    @if($tickets->count() > 0)
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Rang</th>
                <th class="px-4 py-2">Patient</th>
                <th class="px-4 py-2">Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $ticket->numero_ticket }}</td>
                <td class="px-4 py-2">{{ $ticket->user->name }}</td>
                <td class="px-4 py-2">{{ $ticket->category }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Aucun ticket pour ce service et cette catégorie pour l'instant.</p>
    @endif

    <div class="mt-4">
        <form method="POST" action="{{ route('patient.reserve.store') }}">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="category" value="{{ $category }}">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Réserver et payer
            </button>
        </form>
    </div>
</div>
@endsection
