<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // On importe le modèle Notification

class NotificationController extends Controller
{
    // 🔹 Enregistre une nouvelle notification (utilisé par l’admin)
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Création de la notification dans la base
        Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
        ]);

        // Retour au dashboard avec un message succès
        return back()->with('success', 'Notification envoyée avec succès !');
    }

    // 🔹 Liste les notifications du patient connecté
    public function index()
    {
        // Récupère toutes les notifications pour l'utilisateur connecté
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Retourne la vue patient.notifications avec les données
        return view('patient.notifications', compact('notifications'));
    }
}
