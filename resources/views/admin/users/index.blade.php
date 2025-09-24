@extends('admin.layout')

@section('title', 'Patients')

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
