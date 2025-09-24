<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\NotificationController;
use App\Models\User; // On importe le modèle User pour récupérer les patients
use App\Models\Notification; // ✅ On importe aussi Notification
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicesController; // Ajout du controller ServicesController

/*
|-------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great! 
| 
*/

Route::get('/', function () {
    return view('welcome');
});

// Route pour enregistrer la notification depuis le formulaire admin
Route::post('/notifications', [NotificationController::class, 'store'])
    ->name('notifications.store')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard admin avec envoi de la liste des patients
Route::get('/admin/dashboard', function () {
    $patients = User::where('role', 'patient')->get(); // récupère tous les patients
    return view('admin.dashboard', compact('patients'));
})->name('admin.dashboard');

// Route pour l'agent
Route::get('/agent/dashboard', fn() => view('agent.dashboard'))->name('agent.dashboard');

// Pour le patient
Route::middleware(['auth'])->group(function () {
    Route::get('/patient/dashboard', function () {
        // ✅ On récupère toutes les notifications du patient connecté
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ On envoie les notifications à la vue patient.dashboard
        return view('patient.dashboard', compact('notifications'));
    })->name('patient.dashboard');
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/reserve', [TicketController::class, 'create'])->name('patient.reserve');
    Route::post('/patient/reserve', [TicketController::class, 'store'])->name('patient.reserve.store');
    Route::get('/patient/ranks/{service}/{category}', [TicketController::class, 'ranks'])->name('patient.ranks');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/patient/tickets', [TicketController::class, 'index'])->name('patient.tickets');
});

Route::get('/patient/rangs/{service}/{category}', [TicketController::class, 'rangs'])
    ->name('patient.rangs')
    ->middleware('auth');

Route::post('/payment/callback', [TicketController::class, 'callback'])->name('patient.payment.callback');

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/notifications', [NotificationController::class, 'index'])->name('patient.notifications');
});

// Routes Admin (avec préfixe admin)
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/notifications', [AdminController::class, 'sendNotification'])->name('notifications'); // Changé de 'notifications' à 'sendNotification'
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// Routes pour la gestion des services
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // Liste des services
    Route::get('/services', [ServicesController::class, 'index'])->name('services');
    
    // Formulaire d'ajout de service
    Route::get('/services/ajouter', [ServicesController::class, 'ajouter'])->name('services.ajouter');
    
    // Enregistrement d'un service (Méthode POST)
    Route::post('/services', [ServicesController::class, 'store'])->name('services.store');
    
    // Formulaire de modification d'un service
    Route::get('/services/modifier/{id}', [ServicesController::class, 'modifier'])->name('services.modifier');
    
    // Mise à jour d'un service (Méthode PUT)
    Route::put('/services/{id}', [ServicesController::class, 'update'])->name('services.update');
    
    // Suppression d'un service
    Route::delete('/services/{id}', [ServicesController::class, 'supprimer'])->name('services.supprimer');
});



require __DIR__.'/auth.php';
