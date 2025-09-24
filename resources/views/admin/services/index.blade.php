@extends('admin.layout')

@section('title', 'Liste des services')

@section('page-title', 'Liste des services')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.services.ajouter') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Ajouter un service
        </a>
    </div>

    <div class="w-full max-w-3xl mx-auto">
        <table class="w-full bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border p-2 text-left">Nom du service</th>
                    <th class="border p-2 text-left w-48">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td class="border p-2">{{ $service->name }}</td>
                        <td class="border p-2 text-left w-48">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.services.modifier', $service->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Modifier
                                </a>
                                <form action="{{ route('admin.services.supprimer', $service->id) }}" method="POST" onsubmit="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
