@extends('admin.layout')

@section('title', 'Gestion des tickets')
<<<<<<< HEAD

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
=======
@section('page-title', 'Gestion des tickets')

@section('content')
<div class="space-y-6">
    <!-- En-tête -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Gestion des tickets</h1>
            <p class="text-gray-600">Suivez et gérez les tickets de vos patients</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-blue-50 rounded-lg px-4 py-2">
                <span class="text-sm text-blue-700 font-medium">{{ $tickets->count() }} ticket(s) en attente</span>
            </div>
        </div>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <span class="text-green-700 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tableau des tickets -->
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Numéro</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Patient</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Service</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Catégorie</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Statut</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($tickets as $ticket)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-ticket-alt text-blue-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-800">{{ $ticket->numero_ticket }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-purple-600 font-semibold text-sm">
                                    {{ substr($ticket->user->name, 0, 1) }}
                                </span>
                            </div>
                            <span class="text-gray-800">{{ $ticket->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $ticket->service->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                            {{ $ticket->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($ticket->status == 'en_attente')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 capitalize">
                                <i class="fas fa-clock mr-1"></i> {{ $ticket->status }}
                            </span>
                        @elseif($ticket->status == 'en_cours')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 capitalize">
                                <i class="fas fa-spinner mr-1"></i> {{ $ticket->status }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                <i class="fas fa-check mr-1"></i> {{ $ticket->status }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.tickets.updateStatus', $ticket) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('PATCH')
                            <div class="relative">
                                <select name="status" onchange="this.form.submit()" 
                                        class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors cursor-pointer">
                                    <option value="en_attente" {{ $ticket->status == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en_cours" {{ $ticket->status == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="termine" {{ $ticket->status == 'termine' ? 'selected' : '' }}>Terminé</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-ticket-alt text-3xl mb-2 opacity-50"></i>
                        <div>Aucun ticket en attente</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-clock text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-blue-600">En attente</p>
                    <p class="text-lg font-semibold text-blue-800">
                        {{ $tickets->where('status', 'en_attente')->count() }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-spinner text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm text-yellow-600">En cours</p>
                    <p class="text-lg font-semibold text-yellow-800">
                        {{ $tickets->where('status', 'en_cours')->count() }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-green-50 rounded-lg p-4 border border-green-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm text-green-600">Terminés</p>
                    <p class="text-lg font-semibold text-green-800">
                        {{ $tickets->where('status', 'termine')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }
    .transition-colors {
        transition-property: color, background-color, border-color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }
</style>
@endsection
>>>>>>> origin/amina
