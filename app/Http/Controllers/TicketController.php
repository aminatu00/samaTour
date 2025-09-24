<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Paydunya\Checkout\CheckoutInvoice;

class TicketController extends Controller
{
    
public function suivre()
{
    $user = auth()->user();

    // Récupérer tous les tickets en attente ou appelés de ce patient
$tickets = $user->tickets()->whereIn('status', ['en_attente', 'appele'])->get();

    // Calculer le rang dans chaque service
    $positions = [];
    foreach ($tickets as $ticket) {
        $countBefore = $ticket->service->tickets()
            ->where('status', 'en_attente')
            ->where('created_at', '<', $ticket->created_at)
            ->count();
        $positions[$ticket->service->id] = $countBefore;
    }

    // Récupérer tous les services
    $services = \App\Models\Service::all();

    return view('patient.suivre', compact('tickets', 'positions', 'services'));
}


public function suivreTicket(Ticket $ticket)
{
    // On récupère tous les tickets du même service encore en attente
    $tickets = Ticket::where('service_id', $ticket->service_id)
        ->where('status', 'en_attente')
        ->orderBy('created_at')
        ->get();

    // Trouver la position du ticket dans la liste
    $position = $tickets->search(function($t) use ($ticket) {
        return $t->id === $ticket->id;
    });

    return view('patient.suivre', [
        'ticket' => $ticket,
        'position' => $position, // 0 = premier à passer
    ]);
}

public function ticketPosition(Ticket $ticket)
{
    $countBefore = Ticket::where('service_id', $ticket->service_id)
                        ->where('status', 'en_attente')
                        ->where('numero_ticket', '<', $ticket->numero_ticket)
                        ->count();

    return response()->json(['before' => $countBefore]);
}



public function index()
{
    $tickets = Ticket::where('user_id', auth()->id())
                     ->with('service')
                     ->paginate(10); // <- ici on utilise paginate au lieu de get()

    return view('patient.tickets', compact('tickets'));
}



public function rangs($serviceId, $category)
{
    // Récupère le service
    $service = Service::findOrFail($serviceId);

    // Récupère tous les tickets du service et de la catégorie en attente
    $tickets = Ticket::where('service_id', $serviceId)
                     ->where('category', $category)
                     ->where('status', 'en_attente')
                     ->orderBy('numero_ticket')
                     ->get();

    return view('patient.rangs', compact('service', 'tickets', 'category'));
}



public function create()
{
    $services = Service::all();

    // Nombre de tickets en attente pour chaque service
    $waitingCounts = Ticket::select('service_id')
        ->selectRaw('COUNT(*) as count')
        ->where('status', 'en_attente')
        ->groupBy('service_id')
        ->pluck('count', 'service_id'); // clé = service_id, valeur = count

    return view('patient.reserve', compact('services', 'waitingCounts'));
}


    // public function ranks($serviceId, $category)
    // {
    //     $tickets = Ticket::where('service_id', $serviceId)
    //                     ->where('category', $category)
    //                     ->orderBy('numero_ticket')
    //                     ->get();

    //     return response()->json($tickets);
    // }

    public function ranks($serviceId, $category)
{
    // Récupère tous les tickets pour ce service et cette catégorie qui sont encore en attente
    $tickets = Ticket::where('service_id', $serviceId)
                    ->where('category', $category)
                    ->where('status', 'en_attente')
                    ->orderBy('numero_ticket')
                    ->get();

    // Compte le nombre de tickets en attente
    $waitingCount = $tickets->count();

    // Prépare la liste à renvoyer côté JS
    $ticketsData = $tickets->map(function($ticket){
        return [
            'numero_ticket' => $ticket->numero_ticket,
            'patient_name' => $ticket->user->name,
            'category' => $ticket->category
        ];
    });

    return response()->json([
        'tickets' => $ticketsData,
        'waiting' => $waitingCount
    ]);
}


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'service_id' => 'required|exists:services,id',
    //         'category' => 'required|in:standard,urgent'
    //     ]);

    //     // Calcul du rang pour ce service et cette catégorie
    //     $lastTicket = Ticket::where('service_id', $request->service_id)
    //                         ->where('category', $request->category)
    //                         ->latest()
    //                         ->first();

    //     $numero_ticket = $lastTicket ? $lastTicket->numero_ticket + 1 : 1;

    //     $ticket = Ticket::create([
    //         'user_id' => Auth::id(),
    //         'service_id' => $request->service_id,
    //         'category' => $request->category,
    //         'status' => 'en_attente',
    //         'numero_ticket' => $numero_ticket,
    //     ]);

    //     // Ici on peut rediriger vers PayDunya pour le paiement
    //     return redirect()->route('patient.dashboard')
    //                      ->with('success', 'Ticket réservé avec succès ! Numéro : ' . $ticket->numero_ticket);
    // }


public function store(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'category' => 'required|in:standard,urgent'
    ]);

    $userId = Auth::id();

    // Vérifier si ce patient a déjà un ticket en attente dans ce service + catégorie
    $existingTicket = Ticket::where('user_id', $userId)
        ->where('service_id', $request->service_id)
        ->where('category', $request->category)
        ->where('status', 'en_attente')
        ->first();

    if ($existingTicket) {
        return redirect()->back()
            ->with('error', 'Vous avez déjà réservé un ticket pour ce service et ce type.');
    }

    // Récupérer le dernier numéro pour ce service + catégorie
    $lastTicket = Ticket::where('service_id', $request->service_id)
        ->where('category', $request->category)
        ->orderBy('numero_ticket', 'desc')
        ->first();

    $numero_ticket = $lastTicket ? $lastTicket->numero_ticket + 1 : 1;

    // Créer le ticket
    $ticket = Ticket::create([
        'user_id' => $userId,
        'service_id' => $request->service_id,
        'category' => $request->category,
        'status' => 'en_attente',
        'numero_ticket' => $numero_ticket,
    ]);

    return redirect()->route('patient.dashboard')
        ->with('success', 'Ticket réservé avec succès ! Numéro : ' . $ticket->numero_ticket);
}


public function serviceQueue(Service $service)
{
    $tickets = $service->tickets()
                       ->where('status', 'en_attente')
                       ->orderBy('created_at')
                       ->get();

    return view('admin.partials.queue', compact('tickets'));
}



public function getTicketPosition(Ticket $ticket)
{
    // Vérifier que ce ticket appartient bien à l'utilisateur connecté
    if ($ticket->user_id !== auth()->id()) {
        abort(403);
    }

    $tickets = Ticket::where('service_id', $ticket->service_id)
        ->where('status', 'en_attente')
        ->orderBy('created_at')
        ->get();

    // Trouver la position du ticket dans la file
    $position = $tickets->search(function($t) use ($ticket) {
        return $t->id === $ticket->id;
    });

    return response()->json([
        'status'   => $ticket->status,
        'position' => $position !== false ? $position + 1 : 0
    ]);
}

public function show(Ticket $ticket)
{
    if ($ticket->user_id !== auth()->id()) {
        abort(403);
    }
    return view('patient.ticket', compact('ticket'));
}

}
