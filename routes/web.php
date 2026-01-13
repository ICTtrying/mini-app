<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TakenController;
use App\Http\Controllers\VandaagController;
use App\Http\Controllers\WeekController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaak');

Route::get('vandaag', [VandaagController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('vandaag');

Route::get('week', [WeekController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('week');

Route::get('/takenMaken', [TakenController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('takenMaken');

Route::post('/takenCreate', [TakenController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('taken.create');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
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
