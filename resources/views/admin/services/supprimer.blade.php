@extends('admin.layout')

@section('title', 'Supprimer un service')

@section('page-title', 'Supprimer le service')

@section('content')
    <form action="{{ route('admin.services.supprimer', $service->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="mb-4">
            <p>Êtes-vous sûr de vouloir supprimer le service "{{ $service->name }}" ?</p>
        </div>

        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
            Supprimer
        </button>
        <a href="{{ route('admin.services') }}" class="px-4 py-2 bg-gray-300 text-white rounded hover:bg-gray-400">
            Annuler
        </a>
    </form>
@endsection
