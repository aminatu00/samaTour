@extends('admin.layout')

@section('title', 'Ajouter un service')

@section('page-title', 'Ajouter un nouveau service')

@section('content')
    <form action="{{ route('admin.services.ajouter') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700 mb-1">Nom du service</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Ajouter le service
        </button>
    </form>
@endsection
