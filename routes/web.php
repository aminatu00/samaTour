<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

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


require __DIR__.'/auth.php';
