@extends('admin.layout')

@section('title', 'Envoyer une Notification')

@section('page-title', 'Envoyer une Notification')

@section('content')
    <p>Envoyer une notification</p>
    <form action="{{ route('notifications.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
        <!-- Patient Selection Dropdown -->
            <label class="block text-gray-700 mb-1">Sélectionner un patient</label>
            <select name="user_id" class="w-full border rounded p-2">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Titre</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Message</label>
            <textarea name="message" rows="4" class="w-full border rounded p-2" required></textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Envoyer
        </button>
    </form>
@endsection
