<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class AdminController extends Controller
{
    // 🔹 Dashboard admin (page principale)
    public function dashboard()
    {
        $patients = User::where('role', 'patient')->get();
        $agents = User::where('role', 'agent')->get();
        return view('admin.dashboard', compact('patients', 'agents'));
    }

    // 🔹 Gestion des utilisateurs
    public function users()
    {
        $users = User::all(); // tous les utilisateurs
        return view('admin.users', compact('users'));
    }

    // 🔹 Rapports / statistiques
    public function reports()
    {
        $patientsCount = User::where('role', 'patient')->count();
        $agentsCount = User::where('role', 'agent')->count();
        $notificationsCount = Notification::count();
        return view('admin.reports', compact('patientsCount', 'agentsCount', 'notificationsCount'));
    }

    // 🔹 Envoyer une notification
    public function sendNotification(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'title' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            Notification::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'message' => $request->message,
            ]);

            return back()->with('success', 'Notification envoyée avec succès !');
        }

        $patients = User::where('role', 'patient')->get();
        // Utilise 'admin.notifications' au lieu de 'admin.send-notification'
        return view('admin.notifications', compact('patients'));
    }

    // 🔹 Paramètres
    public function settings()
    {
        return view('admin.settings');
    }
}
