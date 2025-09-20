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

Route::middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::get('accounts', [RegisteredUserController::class, 'index'])->name('acc_index');

    Route::get('accounts/register', [RegisteredUserController::class, 'create'])->name('acc_register');

    Route::post('accounts/store', [RegisteredUserController::class, 'store'])->name('acc_store');
});

// Route::middleware(['auth', 'Admin'])->group(function () {
//     Route::get('accounts', [RegisteredUserController::class, 'index']);

//     Route::get('accounts/register', [RegisteredUserController::class, 'create']);

//     Route::post('accounts/store', [RegisteredUserController::class, 'store'])
//         ->name('register_store');
// });

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
