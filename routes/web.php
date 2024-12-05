<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Paiements pour un utilisateur
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    // Paiements pour un administrateur
    Route::get('/admin/payments', [PaymentController::class, 'allPayments'])->name('payments.all')->middleware('can:manage-payments');

    // Remboursement
    Route::post('/admin/payments/refund/{transactionId}', [PaymentController::class, 'refund'])->name('payments.refund')->middleware('can:manage-payments');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
});

require __DIR__.'/auth.php';

