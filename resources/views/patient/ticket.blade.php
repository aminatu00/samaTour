@extends('layouts.app')

@section('title', 'Suivi de votre ticket')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Votre ticket</h1>

    <div class="bg-white p-4 shadow rounded mb-6">
        <p><strong>Numéro :</strong> {{ $ticket->numero_ticket }}</p>
        <p><strong>Service :</strong> {{ $ticket->service->name }}</p>
        <p><strong>Catégorie :</strong> {{ ucfirst($ticket->category) }}</p>
        <p><strong>Statut :</strong> <span id="ticket-status">{{ $ticket->status }}</span></p>
    </div>

    <div class="bg-blue-50 p-4 rounded shadow text-center">
        <p class="text-lg font-semibold" id="position-message">
            Calcul de votre position en file...
        </p>
    </div>
</div>

<script>
function refreshPosition() {
    fetch(`/patient/tickets/{{ $ticket->id }}/position`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('ticket-status').innerText = data.status;

            let msg = '';
            if(data.status === 'en_attente'){
                if(data.position > 1){
                    msg = `Il reste ${data.position - 1} personne(s) avant vous.`;
                } else if(data.position === 1){
                    msg = "⚡ Attention : vous êtes le prochain !";
                }
            } else if(data.status === 'appele'){
                msg = "🎉 C'est votre tour ! Rendez-vous au service.";
            } else {
                msg = "Votre ticket est terminé ou annulé.";
            }

            document.getElementById('position-message').innerText = msg;
        });
}

// Rafraîchir toutes les 3 secondes
setInterval(refreshPosition, 3000);
refreshPosition();
</script>
@endsection
