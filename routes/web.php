<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('authUser');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('clients/activate/{client}', [ClientController::class, 'activate'])->name('clients.activate');
    Route::get('clients/deleted', [ClientController::class, 'deleted'])->name('clients.deleted');

    Route::resource('clients', ClientController::class);
});
