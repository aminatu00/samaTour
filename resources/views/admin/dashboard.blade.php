@extends('admin.layout')

@section('title', 'Dashboard Admin/Agent')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Tableau de bord Admin/Agent</h1>

    {{-- Résumé --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold text-gray-700">Tickets en attente</h2>
            <p class="text-2xl font-bold" id="waiting-count">{{ $waitingTicketsCount }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold text-gray-700">Services</h2>
            <p class="text-2xl font-bold">{{ $servicesCount }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-semibold text-gray-700">Patients totaux</h2>
            <p class="text-2xl font-bold">{{ $patientsCount }}</p>
        </div>
    </div>

    {{-- Files d’attente par service --}}
    <h2 class="text-xl font-bold mb-4">Files d’attente</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($services as $service)
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold mb-3">{{ $service->name }}</h3>
                <div id="queue-{{ $service->id }}">
                    @include('admin.partials.queue', [
                        'tickets' => $service->tickets()->where('status', 'en_attente')->orderBy('created_at')->get()
                    ])
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>

function refreshQueue(serviceId) {
    fetch(`/admin/services/${serviceId}/queue`)
        .then(res => res.text())
        .then(html => {
            if(html.trim().length > 0){
                document.querySelector(`#queue-${serviceId}`).innerHTML = html;
            }
        });
}

setInterval(() => {
    @foreach($services as $service)
        refreshQueue({{ $service->id }});
    @endforeach
}, 5000);



// Quand on clique sur "Appeler"
document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('call-ticket')){
        let ticketId = e.target.dataset.id;
        let serviceId = e.target.dataset.service;
        fetch(`/admin/tickets/${ticketId}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({status: 'appele'})
        }).then(() => refreshQueue(serviceId));
    }
});

// Rafraîchissement automatique toutes les 5 secondes


</script>
@endsection
