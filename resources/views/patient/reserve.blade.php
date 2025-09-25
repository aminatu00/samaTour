@extends('patient.layout')

@section('title', 'Réserver un ticket')
@section('page-title', 'Réserver un ticket')

@section('content')
<div class="space-y-8">
    <!-- En-tête -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Réserver votre ticket</h1>
        <p class="text-gray-600">Choisissez un service et réservez en toute simplicité</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Formulaire de réservation -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-medical-blue to-medical-teal rounded-xl flex items-center justify-center">
                    <i class="fas fa-ticket text-white text-lg"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Nouvelle réservation</h2>
            </div>

            <form id="reserve-form" action="{{ route('patient.reserve.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Sélection du service -->
                <div>
                    <label for="service_id" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-hospital mr-2 text-medical-blue"></i>Service médical
                    </label>
                    <select id="service_id" name="service_id" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300">
                        <option value="">-- Choisir un service --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Type de ticket -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-tag mr-2 text-medical-blue"></i>Type de ticket
                    </label>
                    <select id="category" name="category" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-medical-blue focus:border-transparent transition-all duration-300">
                        <option value="standard">🟢 Standard</option>
                        <option value="urgent">🔴 Urgent</option>
                    </select>
                </div>

                <!-- Bouton de réservation -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-medical-blue to-medical-teal text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-check-circle mr-2"></i>Confirmer la réservation
                </button>
            </form>
        </div>

        <!-- Informations en temps réel -->
        <div class="space-y-6">
            <!-- Carte statistiques -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-medical-blue text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">File d'attente</h3>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <div class="text-2xl font-bold text-medical-blue" id="waiting-count">0</div>
                        <div class="text-sm text-gray-600">Patients en attente</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-xl">
                        <div class="text-2xl font-bold text-medical-green" id="average-time">~15min</div>
                        <div class="text-sm text-gray-600">Temps d'attente</div>
                    </div>
                </div>
            </div>

            <!-- Prochain ticket disponible -->
            <div class="bg-gradient-to-r from-medical-green to-emerald-500 rounded-2xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm opacity-90">Prochain ticket</div>
                        <div class="text-2xl font-bold" id="next-ticket">#001</div>
                    </div>
                    <i class="fas fa-arrow-right text-2xl opacity-70"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des tickets en attente -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-orange-500 text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Tickets en attente</h3>
                </div>
                <span class="text-sm text-gray-500" id="last-update">Mis à jour à --:--</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Position
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Patient
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Statut
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="tickets-table">
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-search text-3xl mb-2 opacity-50"></i>
                            <div>Choisissez un service pour voir la file d'attente</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_id');
    const categorySelect = document.getElementById('category');

    serviceSelect.addEventListener('change', fetchRanks);
    categorySelect.addEventListener('change', fetchRanks);

    function fetchRanks() {
        let service = serviceSelect.value;
        let category = categorySelect.value;

        if (!service) {
            document.getElementById('tickets-table').innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-search text-3xl mb-2 opacity-50"></i>
                        <div>Choisissez un service pour voir la file d'attente</div>
                    </td>
                </tr>`;
            return;
        }

        // Animation de chargement
        document.getElementById('tickets-table').innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-8 text-center">
                    <div class="flex justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-medical-blue"></div>
                    </div>
                    <div class="mt-2 text-gray-500">Chargement des données...</div>
                </td>
            </tr>`;

        fetch(`/patient/ranks/${service}/${category}`)
            .then(res => res.json())
            .then(data => {
                let tickets = data.tickets || [];
                let waiting = data.waiting || 0;

                // Mise à jour des statistiques
                document.getElementById('waiting-count').innerText = waiting;
                document.getElementById('last-update').textContent = `Mis à jour à ${new Date().toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit'})}`;

                // Mise à jour du tableau
                let tbody = document.getElementById('tickets-table');
                tbody.innerHTML = '';

                if (tickets.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-check-circle text-3xl mb-2 text-green-500"></i>
                                <div>Aucun ticket en attente pour ce service</div>
                            </td>
                        </tr>`;
                    return;
                }

                tickets.forEach((ticket, index) => {
                    const badgeClass = ticket.category === 'urgent' 
                        ? 'bg-red-100 text-red-800' 
                        : 'bg-blue-100 text-blue-800';
                    
                    const statusClass = index === 0 
                        ? 'bg-green-100 text-green-800' 
                        : 'bg-yellow-100 text-yellow-800';

                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-lg font-bold text-gray-800">#${String(index + 1).padStart(3, '0')}</span>
                                    ${index === 0 ? '<span class="ml-2 px-2 py-1 bg-green-500 text-white text-xs rounded-full">En cours</span>' : ''}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">${ticket.patient_name}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full ${badgeClass}">
                                    ${ticket.category === 'urgent' ? '🔴 Urgent' : '🟢 Standard'}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full ${statusClass}">
                                    ${index === 0 ? 'En consultation' : 'En attente'}
                                </span>
                            </td>
                        </tr>`;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('tickets-table').innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-red-500">
                            <i class="fas fa-exclamation-triangle text-3xl mb-2"></i>
                            <div>Erreur lors du chargement des données</div>
                        </td>
                    </tr>`;
            });
    }

    // Animation d'entrée
    const elements = document.querySelectorAll('.bg-white');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            el.style.transition = 'all 0.6s ease-out';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>
@endsection