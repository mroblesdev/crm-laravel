<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowUpsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('authUser');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('clients/activate/{client}', [ClientController::class, 'activate'])->name('clients.activate');
    Route::get('clients/deleted', [ClientController::class, 'deleted'])->name('clients.deleted');

    Route::resource('clients', ClientController::class);

    Route::prefix('clients/{client}')->name('clients.contacts.')->group(function () {
        Route::post('/', [ContactController::class, 'store'])->name('store');
        Route::get('{contact}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::put('{contact}', [ContactController::class, 'update'])->name('update');
        Route::delete('{contact}', [ContactController::class, 'destroy'])->name('destroy');
    });

    Route::resource('clients.followups', FollowUpsController::class)->only(['index', 'show', 'store', 'update']);

    Route::resource('tasks', TaskController::class);
});
