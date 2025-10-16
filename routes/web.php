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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', function () {
    return view('index');
})->name('index');

// Rutas de autenticación

// Mostrar el formulario de login (GET)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Procesar login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Mostrar formulario de registro (GET)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Procesar registro (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard redirige según rol
Route::middleware('auth')->group(function () {

    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Usuario normal
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])
        ->name('user.dashboard');
});
