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

// Rutas de autenticación
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/index', function () {
    return view('index');
})->name('index');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
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
