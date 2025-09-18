@extends('patient.layout')

@section('title', 'Réserver un ticket')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Réserver un ticket</h1>

    <form id="reserve-form" action="{{ route('patient.reserve.store') }}" method="POST" class="mb-6">
        @csrf

        <div class="mb-4">
            <label for="service_id" class="block mb-2 font-semibold">Service</label>
            <select id="service_id" name="service_id" class="border rounded p-2 w-full">
                <option value="">-- Choisir un service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="category" class="block mb-2 font-semibold">Type de ticket</label>
            <select id="category" name="category" class="border rounded p-2 w-full">
                <option value="standard">Standard</option>
                <option value="urgent">Urgent</option>
            </select>
        </div>

        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Réserver 
        </button>
    </form>

    {{-- Affichage du nombre de patients en attente --}}
    <p class="mb-2 font-semibold">
        Patients en attente pour ce service : 
        <span id="waiting-count">0</span>
    </p>

    <h2 class="text-xl font-bold mb-2">Tickets en attente pour ce service</h2>
    <table class="w-full border rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Numéro</th>
                <th class="px-4 py-2">Patient</th>
                <th class="px-4 py-2">Catégorie</th>
            </tr>
        </thead>
        <tbody id="tickets-table">
            <tr><td colspan="3" class="text-center p-4">Choisir un service et un type pour voir les rangs</td></tr>
        </tbody>
    </table>
</div>

<script>
document.getElementById('service_id').addEventListener('change', fetchRanks);
document.getElementById('category').addEventListener('change', fetchRanks);

function fetchRanks() {
    let service = document.getElementById('service_id').value;
    let category = document.getElementById('category').value;

    if (!service) return;

    fetch(`/patient/ranks/${service}/${category}`)
        .then(res => res.json())
        .then(data => {
            // data.tickets = liste des tickets
            // data.waiting = nombre de patients en attente
            let tickets = data.tickets || [];
            let waiting = data.waiting || 0;

            document.getElementById('waiting-count').innerText = waiting;

            let tbody = document.getElementById('tickets-table');
            tbody.innerHTML = '';
            if(tickets.length === 0){
                tbody.innerHTML = `<tr><td colspan="3" class="text-center p-4">Aucun ticket en attente</td></tr>`;
                return;
            }
            tickets.forEach(ticket => {
                tbody.innerHTML += `<tr>
                    <td class="border px-4 py-2">${ticket.numero_ticket}</td>
                    <td class="border px-4 py-2">${ticket.patient_name}</td>
                    <td class="border px-4 py-2">${ticket.category}</td>
                </tr>`;
            });
        });
}
</script>
@endsection
