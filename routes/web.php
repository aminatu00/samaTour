<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes Auth
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications patient
    Route::get('/patient/notifications', [NotificationController::class, 'index'])
        ->name('patient.notifications')->middleware('role:patient');
    
    // Dashboard patient
    Route::get('/patient/dashboard', function () {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('patient.dashboard', compact('notifications'));
    })->name('patient.dashboard');

    // Tickets patient
    Route::get('/patient/tickets', [TicketController::class, 'index'])->name('patient.tickets');
    Route::middleware('role:patient')->group(function () {
        Route::get('/patient/reserve', [TicketController::class, 'create'])->name('patient.reserve');
        Route::post('/patient/reserve', [TicketController::class, 'store'])->name('patient.reserve.store');
        Route::get('/patient/ranks/{service}/{category}', [TicketController::class, 'ranks'])->name('patient.ranks');
    });

    // Callback paiement
    Route::post('/payment/callback', [TicketController::class, 'callback'])->name('patient.payment.callback');
});

// Route pour enregistrer la notification depuis le formulaire admin
Route::post('/notifications', [NotificationController::class, 'store'])
    ->name('notifications.store')->middleware('auth');

// Dashboard admin
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

require __DIR__.'/auth.php';
