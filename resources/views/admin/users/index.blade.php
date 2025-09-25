@extends('admin.layout')

@section('title', 'Patients')
<<<<<<< HEAD

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Liste des patients</h1>

    <a href="{{ route('admin.patients.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-4 inline-block">
        Ajouter un patient
    </a>

    <table class="w-full border rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 border">Nom</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
           @forelse($users as $user)
<tr>
    <td class="border px-4 py-2">{{ $user->name }}</td>
    <td class="border px-4 py-2">{{ $user->email }}</td>
    <td class="border px-4 py-2">
        <a href="{{ route('admin.patients.edit', $user) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Modifier</a>
        <form action="{{ route('admin.patients.destroy', $user) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Supprimer</button>
        </form>
    </td>
</tr>
@empty
<tr><td colspan="3" class="text-center p-4">Aucun patient trouvé</td></tr>
@endforelse

        </tbody>
    </table>
</div>
@endsection
=======
@section('page-title', 'Gestion des patients')

@section('content')
<div class="space-y-6">
    <!-- En-tête -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Liste des patients</h1>
            <p class="text-gray-600">Gérez les comptes patients de votre établissement</p>
        </div>
        <a href="{{ route('admin.patients.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Ajouter un patient
        </a>
    </div>

    <!-- Tableau simplifié mais moderne -->
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Patient</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold text-sm">
                                    {{ substr($user->name, 0, 1) }}
                                </span>
                            </div>
                            <span class="font-medium text-gray-800">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.patients.edit', $user) }}" 
                               class="px-3 py-1 bg-blue-100 text-blue-600 rounded text-sm hover:bg-blue-200 transition-colors">
                                Modifier
                            </a>
                            <form action="{{ route('admin.patients.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Supprimer ce patient ?')"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded text-sm hover:bg-red-200 transition-colors">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-3xl mb-2 opacity-50"></i>
                        <div>Aucun patient trouvé</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Statistique simple -->
    <div class="bg-blue-50 rounded-lg p-4">
        <div class="flex items-center space-x-3">
            <i class="fas fa-info-circle text-blue-500"></i>
            <div class="text-sm text-blue-700">
                <strong>{{ $users->count() }}</strong> patient(s) enregistré(s) dans le système
            </div>
        </div>
    </div>
</div>

<style>
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }
</style>
@endsection
>>>>>>> origin/amina
