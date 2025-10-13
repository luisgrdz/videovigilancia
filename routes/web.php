<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

/* Route::get('/', function () {
    return view('welcome');
})->name('home'); */

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Camaras', [App\Http\Controllers\CamarasController::class, 'index'])->name('camaras');
Route::get('/Administracion', [App\Http\Controllers\AdministracionController::class, 'index'])->name('camaras');
Route::get('/Ajustes', [App\Http\Controllers\AjustesController::class, 'index'])->name('camaras');
Route::get('/Historial', [App\Http\Controllers\HistorialController::class, 'index'])->name('camaras');
Route::get('/Notificacion', [App\Http\Controllers\NotificacionController::class, 'index'])->name('camaras');





Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
