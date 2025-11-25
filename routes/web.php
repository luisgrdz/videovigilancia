<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\SupervisorController;


Route::view('/', 'index')->name('index');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'no_cache', 'role:admin'])
    ->prefix('admin')       
    ->name('admin.')       
    ->group(function () {

        // Dashboard Admin (Ruta: admin.dashboard)
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        Route::prefix('personal')->name('personal.')->group(function () {
            Route::get('/', [PersonalController::class, 'index'])->name('index');
            Route::get('/create', [PersonalController::class, 'create'])->name('create');
            Route::post('/', [PersonalController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [PersonalController::class, 'edit'])->name('edit');
            Route::patch('/{user}', [PersonalController::class, 'update'])->name('update');
            Route::delete('/{user}', [PersonalController::class, 'destroy'])->name('destroy');
            Route::patch('/{user}/toggle', [PersonalController::class, 'toggle'])->name('toggle');
        });

    
        Route::resource('cameras', CameraController::class);
    });

    
    Route::middleware(['auth', 'no_cache', 'role:user'])
        ->prefix('user')      
        ->name('user.')         
        ->group(function () {
    
            // Dashboard User (Ruta: user.dashboard)
            Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        
            Route::prefix('cameras')->name('cameras.')->group(function () {
                Route::get('/', [CameraController::class, 'index'])->name('index');
                Route::get('/create', [CameraController::class, 'create'])->name('create');
                Route::get('/{camera}/edit', [CameraController::class, 'edit'])->name('edit');
                Route::post('/', [CameraController::class, 'store'])->name('store');
                Route::get('/{camera}', [CameraController::class, 'show'])->name('show');
            });
        });
    Route::middleware(['auth', 'no_cache', 'role:supervisor'])
        ->prefix('supervisor')      
        ->name('supervisor.')         
        ->group(function () {
    
            // Dashboard User (Ruta: user.dashboard)
            Route::get('/dashboard', [SupervisorController::class, 'dashboard'])->name('dashboard');
        
            Route::prefix('cameras')->name('cameras.')->group(function () {
                Route::get('/', [CameraController::class, 'index'])->name('index');
                Route::get('/create', [CameraController::class, 'create'])->name('create');
                Route::get('/{camera}/edit', [CameraController::class, 'edit'])->name('edit');
                Route::post('/', [CameraController::class, 'store'])->name('store');
                Route::get('/{camera}', [CameraController::class, 'show'])->name('show');
            });
        });