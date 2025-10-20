<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se definen todas las rutas de la aplicación.
| Se mantiene solo lo esencial y se usan controladores propios.
|
*/

// Página de inicio
Route::get('/', function () {
    return view('index');
})->name('index');


// --------------------------------------------
// RUTAS DE AUTENTICACIÓN
// --------------------------------------------

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cambio de contraseña
Route::get('/password/change', [AuthController::class, 'showChangePassword'])->name('password.change.form');
Route::post('/password/change', [AuthController::class, 'updatePassword'])->name('password.change.post');

// Rutas protegidas
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Dashboard Usuario normal
    Route::get('/users/dashboard', [UserController::class, 'dashboard'])
        ->name('users.dashboard');

    // Gestión de personal (solo admin)
    Route::get('/users/add', [AuthController::class, 'showAddUser'])->name('users.add');
    Route::post('/users/add', [AuthController::class, 'addUser'])->name('users.store');

    // rutas para gestión de usuarios
    Route::prefix('admin')->group(function () {
        Route::get('/personal', [PersonalController::class, 'index'])->name('admin.personal'); // <-- aquí defines el nombre
        Route::get('/personal/create', [PersonalController::class, 'create'])->name('users.add');
        Route::post('/personal', [PersonalController::class, 'store'])->name('users.store');
        Route::get('/personal/{user}/edit', [PersonalController::class, 'edit'])->name('users.edit');
        Route::patch('/personal/{user}', [PersonalController::class, 'update'])->name('users.update');
        Route::delete('/personal/{user}', [PersonalController::class, 'destroy'])->name('users.destroy');
        Route::patch('/personal/{user}/toggle', [PersonalController::class, 'toggle'])->name('users.toggle'); // Bloquear/Activar
    });


    // Gestión de cámaras (solo admin)
    Route::get('/cameras', [AdminController::class, 'viewCameras'])->name('cameras.index');
    Route::get('/cameras/add', [AdminController::class, 'showAddCamera'])->name('cameras.add');
    Route::post('/cameras/add', [AdminController::class, 'addCamera'])->name('cameras.store');
    Route::get('/cameras/{id}', [AdminController::class, 'viewCamera'])->name('cameras.show');
});
