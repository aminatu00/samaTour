@if($tickets->count() > 0)
    <table class="w-full border rounded mb-2 text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-2 py-1 border">#</th>
                <th class="px-2 py-1 border">Patient</th>
                <th class="px-2 py-1 border">Catégorie</th>
                <th class="px-2 py-1 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $index => $ticket)
                <tr>
                    <td class="border px-2 py-1">{{ $index + 1 }}</td>
                    <td class="border px-2 py-1">{{ $ticket->user->name }}</td>
                    <td class="border px-2 py-1 capitalize">{{ $ticket->category }}</td>
                    <td class="border px-2 py-1">
                        <button class="px-2 py-1 bg-green-500 text-white rounded call-ticket"
                                data-id="{{ $ticket->id }}"
                                data-service="{{ $ticket->service_id }}">
                            Appeler
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-gray-500 italic">Aucun patient en attente</p>
@endif
