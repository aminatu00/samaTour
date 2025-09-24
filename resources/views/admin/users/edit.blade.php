@extends('admin.layout')

@section('title', 'Modifier un patient')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Modifier le patient</h1>

    <form action="{{ route('admin.patients.update', $patient) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold mb-1">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" class="w-full border rounded p-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" class="w-full border rounded p-2">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block font-semibold mb-1">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="password" id="password" class="w-full border rounded p-2">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block font-semibold mb-1">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Mettre à jour</button>
        <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Retour</a>
    </form>
</div>
@endsection
