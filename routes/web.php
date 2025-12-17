<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\TaskListController;
use App\Http\Controllers\Web\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Perfil
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::middleware('auth')->group(function () {
    // CRUD de listas
    Route::post('/listsweb', [TaskListController::class, 'store'])->name('listsweb.store');
    Route::get('/listsweb/{list}', [TaskListController::class, 'show'])->name('listsweb.show');
    Route::patch('/listsweb/{list}', [TaskListController::class, 'update'])->name('listsweb.update');
    Route::delete('/listsweb/{list}', [TaskListController::class, 'destroy'])->name('listsweb.destroy');

    // CRUD de tarefas
    Route::post('/tasksweb', [TaskController::class, 'store'])->name('tasksweb.store');
    Route::patch('/tasksweb/{task}', [TaskController::class, 'update'])->name('tasksweb.update');
    Route::delete('/tasksweb/{task}', [TaskController::class, 'destroy'])->name('tasksweb.destroy');
});


require __DIR__.'/auth.php';