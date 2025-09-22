<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semuanya bisa liat ini tp readonly
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('customers/', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers_index');
    // services
    Route::get('services/', [App\Http\Controllers\ServiceController::class, 'index'])->name('service_index');
});

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

    // create service
    Route::get('services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('service_register');
    Route::post('services/store', [App\Http\Controllers\ServiceController::class, 'store'])->name('service_store');
    // edit service
    Route::get('services/{service}/edit', [App\Http\Controllers\ServiceController::class, 'edit'])->name('service_edit');
    Route::put('services/{service}', [App\Http\Controllers\ServiceController::class, 'update'])->name('service_update');
    // delete service
    Route::delete('services/{service}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('service_delete');
});

// Kasir (akses pengguna ter-autentikasi)
Route::middleware(['auth', 'Operator'])->group(function () {
    // kasir
    Route::get('kasir', [TransactionController::class, 'index'])->name('kasir_index');
    Route::get('kasir/customers', [TransactionController::class, 'customers'])->name('kasir_customers');
    Route::get('kasir/services', [TransactionController::class, 'services'])->name('kasir_services');
    Route::post('kasir/orders', [TransactionController::class, 'store'])->name('kasir_store');

    // customers
    // create customer
    Route::get('customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers_register');
    Route::post('customers/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customers_store');
    // edit customer
    Route::get('customers/{customer}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customers_edit');
    Route::put('customers/{customer}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customers_update');
    // delete customer
    Route::delete('customers/{customer}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers_delete');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
