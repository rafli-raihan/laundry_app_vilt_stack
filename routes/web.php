<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Hanya superadmin yang bisa mengakses route di bawah ini
Route::middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::get('accounts/', [RegisteredUserController::class, 'index'])->name('acc_index');
    // create account
    Route::get('accounts/register', [RegisteredUserController::class, 'create'])->name('acc_register');
    Route::post('accounts/store', [RegisteredUserController::class, 'store'])->name('acc_store');
    // edit account
    Route::get('accounts/{user}/edit', [RegisteredUserController::class, 'edit'])->name('acc_edit');
    Route::put('accounts/{user}', [RegisteredUserController::class, 'update'])->name('acc_update');
    // delete account
    Route::delete('accounts/{user}', [RegisteredUserController::class, 'destroy'])->name('acc_delete');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
