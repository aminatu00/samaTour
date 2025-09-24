@extends('admin.layout')

@section('title', 'Modifier un service')

@section('page-title', 'Modifier le service')

@section('content')
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT') <!-- Utilisation de PUT pour la mise à jour -->
        <div>
            <label class="block text-gray-700 mb-1">Nom du service</label>
            <input type="text" name="name" class="w-full border rounded p-2" value="{{ $service->name }}" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Modifier le service
        </button>
    </form>
@endsection
