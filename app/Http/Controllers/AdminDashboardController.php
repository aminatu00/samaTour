<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
 // Dashboard
   
    public function index()
    {
        $tickets = Ticket::where('status', 'en_attente')
                         ->orderBy('created_at')
                         ->get();

        $waitingTicketsCount = $tickets->count();
        $servicesCount = Service::count();
        $patientsCount = User::where('role', 'patient')->count();

        return view('admin.dashboard', compact('tickets', 'waitingTicketsCount', 'servicesCount', 'patientsCount'));
    }

    // public function updateStatus(Request $request, Ticket $ticket)
    // {
    //     $status = $request->input('status');
    //     if (in_array($status, ['en_attente', 'en_cours', 'termine', 'appelé'])) {
    //         $ticket->status = $status;
    //         $ticket->save();
    //     }

    //     return redirect()->route('admin.dashboard')
    //                      ->with('success', 'Ticket mis à jour avec succès');
    // }
public function updateStatus(Request $request, Ticket $ticket)
{
    $ticket->status = $request->status;
    $ticket->save();

    return response()->json(['success' => true]);
}


    // SERVICES
    public function services()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function createService()
    {
        return view('admin.services.create');
    }

    public function storeService(Request $request)
    {
        $request->validate(['name' => 'required']);
        Service::create($request->only('name', 'description'));
        return redirect()->route('admin.services')->with('success', 'Service créé avec succès');
    }

    public function editService(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function updateService(Request $request, Service $service)
    {
        $request->validate(['name' => 'required']);
        $service->update($request->only('name', 'description'));
        return redirect()->route('admin.services')->with('success', 'Service mis à jour');
    }

    public function destroyService(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service supprimé');
    }

    // TICKETS
    public function tickets()
    {
        $tickets = Ticket::with('user','service')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function updateTicketStatus(Request $request, Ticket $ticket)
    {
        $ticket->update(['status' => $request->status]);
        return back()->with('success', 'Statut mis à jour');
    }

    // USERS
  public function users()
{
    $users = User::with('tickets')->where('role', 'patient')->get(); // ✅ filtre par rôle
    return view('admin.users.index', compact('users'));
}



    public function ticketsAjax()
{
    $tickets = Ticket::where('status', 'en_attente')
                     ->orderBy('created_at')
                     ->get()
                     ->map(function($ticket){
                        return [
                            'id' => $ticket->id,
                            'numero_ticket' => $ticket->numero_ticket,
                            'patient_name' => $ticket->user->name,
                            'service_name' => $ticket->service->name,
                            'category' => $ticket->category,
                        ];
                     });

    return response()->json(['tickets' => $tickets]);
}

// Liste des patients
public function patientsIndex() {
    $users = User::where('role', 'patient')->get();

    return view('admin.users.index', compact('users'));
}

// Formulaire de création
public function patientsCreate() {
    return view('admin.users.create');
}

// Stocker un patient
public function patientsStore(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'patient'
    ]);

    return redirect()->route('admin.patients.index')->with('success', 'Patient ajouté !');
}

// Formulaire d'édition
public function patientsEdit(User $patient) {
    return view('admin.patients.edit', compact('patient'));
}

// Mettre à jour un patient
public function patientsUpdate(Request $request, User $patient) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$patient->id,
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $patient->name = $request->name;
    $patient->email = $request->email;
    if($request->password) {
        $patient->password = bcrypt($request->password);
    }
    $patient->save();

    return redirect()->route('admin.patients.index')->with('success', 'Patient mis à jour !');
}

// Supprimer un patient
public function patientsDestroy(User $patient) {
    $patient->delete();
    return redirect()->route('admin.patients.index')->with('success', 'Patient supprimé !');
}


public function dashboard()
{
    $patientsCount = User::where('role', 'patient')->count();
    $servicesCount = Service::count();
    $waitingTicketsCount = Ticket::where('status', 'en_attente')->count();
    $tickets = Ticket::where('status', 'en_attente')->get();
    $services = Service::all(); // ✅ On ajoute ça

    return view('admin.dashboard', compact(
        'patientsCount',
        'servicesCount',
        'waitingTicketsCount',
        'tickets',
        'services' // ✅ Et on le passe à la vue
    ));
}


public function ticketsByService()
{
    $services = Service::with(['tickets' => function($q){
        $q->where('status', 'en_attente')->orderBy('numero_ticket');
    }, 'tickets.user'])->get();

    return response()->json([
        'services' => $services->map(function($service){
            return [
                'id' => $service->id,
                'name' => $service->name,
                'tickets' => $service->tickets->map(function($t){
                    return [
                        'id' => $t->id,
                        'numero_ticket' => $t->numero_ticket,
                        'patient_name' => $t->user->name,
                        'category' => $t->category
                    ];
                })
            ];
        })
    ]);
}



public function serviceQueue(Service $service)
{
    $tickets = $service->tickets()->where('status', 'en_attente')->orderBy('created_at')->get();

    // Vérifie que $tickets n'est pas null et est une collection
    return view('admin.partials.queue', compact('tickets'));
}




}
