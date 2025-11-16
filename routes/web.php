<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CameraController;



// Página de inicio


Route::view('/', 'index')->name('index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'no_cache', 'role:admin'])->group(function (){

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Personal
    Route::prefix('admin/personal')->name('admin.personal.')->group(function () {
        Route::get('/', [PersonalController::class, 'index'])->name('index');
        Route::get('/create', [PersonalController::class, 'create'])->name('create');
        Route::post('/', [PersonalController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [PersonalController::class, 'edit'])->name('edit');
        Route::patch('/{user}', [PersonalController::class, 'update'])->name('update');
        Route::delete('/{user}', [PersonalController::class, 'destroy'])->name('destroy');
        Route::patch('/{user}/toggle', [PersonalController::class, 'toggle'])->name('toggle');
    });

    Route::middleware(['auth', 'no_cache', 'role:admin,user'])->group(function () {

        Route::prefix('cameras')->name('cameras.')->group(function () {
            Route::get('/', [CameraController::class, 'index'])->name('index');
            Route::get('/create', [CameraController::class, 'create'])->name('create');
            Route::post('/', [CameraController::class, 'store'])->name('store');
            Route::get('/{camera}', [CameraController::class, 'show'])->name('show');
            Route::get('/{camera}/edit', [CameraController::class, 'edit'])->name('edit');
            Route::patch('/{camera}', [CameraController::class, 'update'])->name('update');
            Route::delete('/{camera}', [CameraController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware(['auth', 'no_cache', 'role:user'])->group(function () {

    Route::get('/users/dashboard', [UserController::class, 'dashboard'])
        ->name('users.dashboard');
});
