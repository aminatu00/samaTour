@extends('patient.layout')

@section('title', 'Notifications')
@section('page-title', 'Mes Notifications')

@section('content')
<div class="space-y-4">
    @forelse($notifications as $notif)
        <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm hover:shadow-md transition cursor-pointer"
             data-id="{{ $notif->id }}"
             onclick="markAsRead({{ $notif->id }})">

            {{-- Titre et message --}}
            <div class="{{ $notif->read_at ? 'text-gray-700' : 'font-semibold text-blue-900' }}">
                <h3 class="text-base mb-1">{{ $notif->title }}</h3>
                <p class="text-sm text-gray-600">{{ $notif->message }}</p>
            </div>

            {{-- Date + bouton Supprimer --}}
            <div class="mt-4 flex justify-between items-center text-xs text-gray-400">
                <span>{{ $notif->created_at->format('d/m/Y H:i') }}</span>

                <form action="{{ route('patient.notifications.delete', $notif->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-100 text-red-600 px-3 py-1 rounded-md text-xs font-medium hover:bg-red-50 hover:text-red-700 transition">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white p-6 shadow rounded-lg text-center text-gray-500">
            Vous n'avez aucune notification pour l'instant.
        </div>
    @endforelse
</div>

<script>
    function markAsRead(notificationId) {
        const notifElement = document.querySelector(`[data-id='${notificationId}']`);
        notifElement.classList.remove('font-semibold', 'text-blue-900');
        notifElement.classList.add('text-gray-600');

        fetch(`/notifications/${notificationId}/mark-read`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ read: true })
        }).then(response => response.json())
          .then(data => {
              console.log(data.message);
          });
    }
</script>
@endsection
