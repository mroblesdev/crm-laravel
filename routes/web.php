<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowUpsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
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

    Route::get('/calendar', [TaskController::class, 'calendar'])->name('calendar');
    Route::get('/tasks/events', [TaskController::class, 'events'])->name('tasks.events');
    Route::resource('tasks', TaskController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::post('profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
