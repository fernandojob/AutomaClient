<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientPdfController;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Application;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
        Route::post('/', [ClientController::class, 'store'])->name('clients.store');
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
        Route::patch('/{client}', [ClientController::class, 'update'])->name('clients.update');
        Route::delete('/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    });

    Route::get('/send-test-email', function () {
        Mail::to('teste@exemplo.com')->send(new TestEmail());
        return redirect()->back()->with('success', 'E-mail enviado com sucesso!');
    });

    Route::get('/clients/pdf', [ClientPdfController::class, 'generatePDF'])->name('clients.pdf');

    Route::get('/clients/{clientId}/orders', [OrderController::class, 'index']);
    Route::post('/clients/{clientId}/orders', [OrderController::class, 'store']);
});