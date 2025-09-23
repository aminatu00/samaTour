<?php

namespace App\Http\Controllers;

use App\Models\Service; // Assure-toi que le modèle Service est importé
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    // Afficher la liste des services
    public function index()
    {
        // Récupérer tous les services
        $services = Service::all(); // Cette ligne récupère tous les services de la base de données
        return view('admin.services.index', compact('services')); // Envoie la liste à la vue
    }

    // Afficher le formulaire pour ajouter un service
    public function ajouter()
    {
        return view('admin.services.ajouter'); // Affiche la vue pour ajouter un service
    }

    // Ajouter un service dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Créer un nouveau service
        Service::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.services')->with('success', 'Service ajouté avec succès!');
    }

    // Afficher le formulaire pour modifier un service
    public function modifier($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.modifier', compact('service'));
    }

    // Mettre à jour un service dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service = Service::findOrFail($id);
        $service->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.services')->with('success', 'Service mis à jour avec succès!');
    }

    // Supprimer un service de la base de données
    public function supprimer($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Service supprimé avec succès!');
    }
}
