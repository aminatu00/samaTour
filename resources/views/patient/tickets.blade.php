@extends('patient.layout')

@section('title', 'Mes Tickets')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Mes tickets</h1>
    <table class="w-full bg-white shadow rounded-lg">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3">#</th>
                <th class="p-3">Service</th>
                <th class="p-3">Numéro Ticket</th>
                <th class="p-3">Statut</th>
                <th class="p-3">Catégorie</th>
                <th class="p-3">Créé le</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr class="border-b">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $ticket->service->name ?? 'N/A' }}</td>
                    <td class="p-3">{{ $ticket->numero_ticket }}</td>
                    <td class="p-3">{{ $ticket->status }}</td>
                    <td class="p-3">{{ $ticket->category }}</td>
                    <td class="p-3">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
