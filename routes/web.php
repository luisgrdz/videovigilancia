<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Cambio de contraseña (para usuarios con contraseña temporal)
Route::get('/password/change', [AuthController::class, 'showChangePassword'])->name('password.change.form');
Route::post('/password/change', [AuthController::class, 'updatePassword'])->name('password.change.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --------------------------------------------
// RUTAS DE ADMINISTRACIÓN (requiere autenticación)
// --------------------------------------------
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Dashboard Usuario normal
    Route::get('/users/dashboard', [UserController::class, 'dashboard'])
        ->name('users.dashboard');

    // Gestión de personal
    Route::get('/users/add', [AdminController::class, 'showAddUser'])->name('users.add');
    Route::post('/users/add', [AdminController::class, 'addUser'])->name('users.store');

    // Gestión de cámaras
    Route::get('/cameras', [AdminController::class, 'viewCameras'])->name('cameras.index');
    Route::get('/cameras/add', [AdminController::class, 'showAddCamera'])->name('cameras.add');
    Route::post('/cameras/add', [AdminController::class, 'addCamera'])->name('cameras.store');
    Route::get('/cameras/{id}', [AdminController::class, 'viewCamera'])->name('cameras.show');
});
