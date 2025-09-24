@extends('admin.layout')

@section('title', 'Gestion des tickets')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tickets en attente</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Numéro</th>
                <th class="px-4 py-2 border">Patient</th>
                <th class="px-4 py-2 border">Service</th>
                <th class="px-4 py-2 border">Catégorie</th>
                <th class="px-4 py-2 border">Statut</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td class="border px-4 py-2">{{ $ticket->numero_ticket }}</td>
                    <td class="border px-4 py-2">{{ $ticket->user->name }}</td>
                    <td class="border px-4 py-2">{{ $ticket->service->name }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $ticket->category }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $ticket->status }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('admin.tickets.updateStatus', $ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border rounded p-1">
                                <option value="en_attente" {{ $ticket->status == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ $ticket->status == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ $ticket->status == 'termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">Aucun ticket disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
