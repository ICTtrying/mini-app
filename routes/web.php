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

Route::get('vandaag', [DashboardController::class, 'vandaag'])
    ->middleware(['auth', 'verified'])
    ->name('vandaag');

Route::post('vandaag', [DashboardController::class, 'vandaag'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaakVandaag');

Route::get('week', [DashboardController::class, 'week'])
    ->middleware(['auth', 'verified'])
    ->name('week');

Route::post('week', [DashboardController::class, 'week'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaakWeek');

Route::get('school', [DashboardController::class, 'school'])
    ->middleware(['auth', 'verified'])
    ->name('school');

Route::post('school', [DashboardController::class, 'school'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaakSchool');

Route::get('werk', [DashboardController::class, 'werk'])
    ->middleware(['auth', 'verified'])
    ->name('werk');

Route::post('werk', [DashboardController::class, 'werk'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaakWerk');

Route::get('sideProjecten', [DashboardController::class, 'sideProjecten'])
    ->middleware(['auth', 'verified'])
    ->name('sideProjecten');

Route::post('sideProjecten', [DashboardController::class, 'sideProjecten'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaakSideProjecten');

Route::get('prive', [DashboardController::class, 'prive'])
    ->middleware(['auth', 'verified'])
    ->name('prive');

Route::post('prive', [DashboardController::class, 'prive'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaakPrive');
/*taken*/

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
