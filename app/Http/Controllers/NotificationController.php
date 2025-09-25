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
        // Récupère les notifications triées par non lues et par date de création
        $notifications = Notification::where('user_id', auth()->id())
            ->orderByRaw('read_at is NULL desc') // Affiche les non lues en premier
            ->orderBy('created_at', 'desc') // Tri par date de création
            ->get();

        // Retourne la vue patient.notifications
        return view('patient.notifications', compact('notifications'));
    }

    // 🔹 Marquer une notification comme lue
    public function markAsRead($id)
    {
        // Cherche la notification par son ID
        $notification = Notification::findOrFail($id);

        // Marque la notification comme lue en mettant la date actuelle dans read_at
        $notification->read_at = now();
        $notification->save();

        // Retour à la page des notifications avec un message de succès
        return back()->with('success', 'Notification marquée comme lue');
    }

    // 🔹 Supprimer une notification
    public function destroy($id)
    {
        // Cherche la notification par son ID
        $notification = Notification::findOrFail($id);

        // Supprime la notification
        $notification->delete();

        // Retour à la page des notifications avec un message de succès
        return back()->with('success', 'Notification supprimée avec succès');
    }

    // 🔹 Compter les notifications non lues
    public function countUnreadNotifications()
    {
        return Notification::where('user_id', auth()->id()) // Notifications de l'utilisateur connecté
                           ->whereNull('read_at')  // `read_at` est NULL pour les notifications non lues
                           ->count(); // Compte les notifications non lues
    }
}
