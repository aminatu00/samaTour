<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Models\User; // Pour récupérer les patients
use App\Models\Notification;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
//admin


use App\Http\Controllers\AdminDashboardController;

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


// Route pour afficher le formulaire d'envoi de notification côté admin
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/notifications', [AdminController::class, 'sendNotification'])
        ->name('notifications'); // formulaire admin pour envoyer la notif
});

// Route pour enregistrer la notification depuis le formulaire admin
Route::post('/notifications', [NotificationController::class, 'store'])
    ->name('notifications.store')
    ->middleware('auth');

// Route pour afficher les notifications côté patient
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/notifications', [NotificationController::class, 'index'])
        ->name('patient.notifications');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
Route::get('/agent/dashboard', fn() => view('agent.dashboard'))->name('agent.dashboard');
// Route::get('/patient/dashboard', fn() => view('patient.dashboard'))->name('patient.dashboard');


//pour le patient 
Route::middleware(['auth'])->group(function () {
    Route::get('/patient/dashboard', fn() => view('patient.dashboard'))->name('patient.dashboard');
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


// Rafraîchir une file d’attente spécifique
Route::get('services/{service}/queue', [AdminDashboardController::class, 'getServiceQueue']);


// Page de suivi du ticketv
Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('patient.ticket');

// API pour suivre la position en file
Route::get('tickets/{ticket}/position', [TicketController::class, 'getTicketPosition']);



     Route::get('/tickets/{ticket}/position', [TicketController::class, 'ticketPosition']);


Route::patch('/admin/tickets/{ticket}/status', [AdminDashboardController::class, 'updateStatus'])
    ->name('admin.tickets.updateStatus');

Route::get('/mes-tickets/{ticket}', [TicketController::class, 'suivreTicket'])
    ->name('patient.suivre');


    Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/suivre', [TicketController::class, 'suivre'])->name('patient.suivre');
});


// routes/web.php
Route::get('/admin/services/{service}/queue', [AdminDashboardController::class, 'serviceQueue'])
    ->name('admin.services.queue')
    ->middleware(['auth','role:admin']);







//adminnnnnnnnnnnnnn

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Services
    Route::get('services', [AdminDashboardController::class, 'services'])->name('admin.services');
    Route::get('services/create', [AdminDashboardController::class, 'createService'])->name('admin.services.create');
    Route::post('services', [AdminDashboardController::class, 'storeService'])->name('admin.services.store');
    Route::get('services/{service}/edit', [AdminDashboardController::class, 'editService'])->name('admin.services.edit');
    Route::put('services/{service}', [AdminDashboardController::class, 'updateService'])->name('admin.services.update');
    Route::delete('services/{service}', [AdminDashboardController::class, 'destroyService'])->name('admin.services.destroy');

    // Tickets
    Route::get('tickets', [AdminDashboardController::class, 'tickets'])->name('admin.tickets');
    Route::patch('tickets/{ticket}/status', [AdminDashboardController::class, 'updateTicketStatus'])->name('admin.tickets.updateStatus');

    // Users
    Route::get('users', [AdminDashboardController::class, 'users'])->name('admin.users');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/tickets/ajax', [AdminDashboardController::class, 'ticketsAjax'])->name('admin.tickets.ajax');
    Route::patch('/tickets/{ticket}/status', [AdminDashboardController::class, 'updateStatus'])->name('admin.tickets.updateStatus');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Patients
    Route::get('/patients', [AdminDashboardController::class, 'patientsIndex'])->name('admin.patients.index');
    Route::get('/patients/create', [AdminDashboardController::class, 'patientsCreate'])->name('admin.patients.create');
    Route::post('/patients', [AdminDashboardController::class, 'patientsStore'])->name('admin.patients.store');
    Route::get('/patients/{patient}/edit', [AdminDashboardController::class, 'patientsEdit'])->name('admin.patients.edit');
    Route::put('/patients/{patient}', [AdminDashboardController::class, 'patientsUpdate'])->name('admin.patients.update');
    Route::delete('/patients/{patient}', [AdminDashboardController::class, 'patientsDestroy'])->name('admin.patients.destroy');
});
Route::get('/admin/tickets/ajax', [AdminDashboardController::class, 'ticketsByService'])
     ->name('admin.tickets.ajax');


require __DIR__.'/auth.php';
