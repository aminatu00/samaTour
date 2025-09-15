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
    
public function index()
{
    $tickets = Ticket::where('user_id', auth()->id())
                     ->with('service')
                     ->get();

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
        'category'   => 'required|in:standard,urgent',
    ]);

    // 1. Création du ticket
    $ticket = Ticket::create([
        'user_id'       => auth()->id(),
        'service_id'    => $request->service_id,
        'category'      => $request->category,
        'status'        => 'en_attente',
        'numero_ticket' => $this->getNextTicketNumber($request->service_id, $request->category),
    ]);

    // 2. Génération de la facture PayDunya
    $invoice = new CheckoutInvoice();

    $invoice->addItem(
        "Ticket pour le service {$ticket->service->name}", // Nom article
        1,                                                 // Quantité
        1000,                                              // Prix unitaire (FCFA)
        "Numéro de ticket: {$ticket->numero_ticket}"       // Description
    );

    // Définir les URLs
    $invoice->setCallbackUrl(route('patient.payment.callback')); // Notification PayDunya
    $invoice->setCancelUrl(route('patient.dashboard'));          // Annulation
    $invoice->setReturnUrl(route('patient.dashboard'));          // Succès

    // 3. Création de la facture PayDunya et redirection
    if ($invoice->create()) {
        return redirect($invoice->response_text->checkout_url);
    } else {
        return back()->with('error', 'Erreur PayDunya : '.$invoice->response_text);
    }
}



public function callback(Request $request)
{
    $token = $request->input('token'); // PayDunya envoie le token de la facture

    if (!$token) {
        return response()->json(['error' => 'Token manquant'], 400);
    }

    // Vérifier le statut de la facture chez PayDunya
    $invoice = new \Paydunya\Checkout\CheckoutInvoice();

    if ($invoice->confirm($token)) {
        // ✅ Paiement réussi
        $ticketId = $invoice->getCustomData("ticket_id");

        if ($ticketId) {
            $ticket = Ticket::find($ticketId);
            if ($ticket) {
                $ticket->status = 'paye';
                $ticket->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Paiement confirmé avec succès'
        ]);
    } else {
        // ❌ Paiement échoué
        return response()->json([
            'success' => false,
            'message' => 'Paiement non confirmé',
            'error'   => $invoice->response_text
        ], 400);
    }
}

}
