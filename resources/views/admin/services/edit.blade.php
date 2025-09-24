@extends('admin.layout')

@section('title', 'Modifier un service')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Modifier le service</h1>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold">Nom du service</label>
            <input type="text" name="name" id="name" 
                   value="{{ $service->name }}" 
                   class="border rounded p-2 w-full" required>
        </div>

        <div>
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" 
                      class="border rounded p-2 w-full">{{ $service->description }}</textarea>
        </div>

        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Mettre à jour
        </button>
        <a href="{{ route('admin.services') }}" class="ml-2 text-gray-600">Annuler</a>
    </form>
</div>
@endsection
