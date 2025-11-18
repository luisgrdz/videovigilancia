<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CameraController;

// --- RUTAS PÚBLICAS ---
Route::view('/', 'index')->name('index');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- GRUPO ADMINISTRADOR ---
Route::middleware(['auth', 'no_cache', 'role:admin'])
    ->prefix('admin')       // Todas las URLs empiezan con /admin/...
    ->name('admin.')        // Todos los nombres empiezan con admin.
    ->group(function () {

        // Dashboard Admin (Ruta: admin.dashboard)
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Personal (Ruta base: admin.personal.*)
        Route::prefix('personal')->name('personal.')->group(function () {
            Route::get('/', [PersonalController::class, 'index'])->name('index');
            Route::get('/create', [PersonalController::class, 'create'])->name('create');
            Route::post('/', [PersonalController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [PersonalController::class, 'edit'])->name('edit');
            Route::patch('/{user}', [PersonalController::class, 'update'])->name('update');
            Route::delete('/{user}', [PersonalController::class, 'destroy'])->name('destroy');
            Route::patch('/{user}/toggle', [PersonalController::class, 'toggle'])->name('toggle');
        });

        // Cámaras Admin (Ruta base: admin.cameras.*)
        // Usamos resource para limpiar el código, esto crea index, store, update, etc. automáticamente
        // Si prefieres manuales, borra esta línea y usa tu bloque manual, pero NO ambos.
        Route::resource('cameras', CameraController::class);
    });


// --- GRUPO USUARIOS (Separado del Admin) ---
Route::middleware(['auth', 'no_cache', 'role:user'])
    ->prefix('user')        // Todas las URLs empiezan con /user/...
    ->name('user.')         // Todos los nombres empiezan con user.
    ->group(function () {

        // Dashboard User (Ruta: user.dashboard)
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // Cámaras User (Ruta base: user.cameras.*)
        // Solo definimos las que el usuario tiene permitido ver
        Route::prefix('cameras')->name('cameras.')->group(function () {
            Route::get('/', [CameraController::class, 'index'])->name('index');
            Route::get('/create', [CameraController::class, 'create'])->name('create');
            Route::get('/{camera}/edit', [CameraController::class, 'edit'])->name('edit');
            Route::post('/', [CameraController::class, 'store'])->name('store');
            Route::get('/{camera}', [CameraController::class, 'show'])->name('show');
        });
    });
