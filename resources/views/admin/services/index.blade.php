@extends('admin.layout')

@section('title', 'Gestion des services')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Liste des services</h1>

    <a href="{{ route('admin.services.create') }}" 
       class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-4 inline-block">
        + Nouveau service
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Nom</th>
                <th class="px-4 py-2 border">Description</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td class="border px-4 py-2">{{ $service->name }}</td>
                    <td class="border px-4 py-2">{{ $service->description ?? '-' }}</td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <a href="{{ route('admin.services.edit', $service) }}" 
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Modifier
                        </a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Supprimer ce service ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center p-4">Aucun service disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
