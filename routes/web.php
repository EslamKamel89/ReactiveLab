<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

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
Route::group(['middleware' => 'auth', 'prefix' => 'lessons'], function () {
    Route::view('/users', 'lessons.users')->name('lessons.users');
    Route::view('/flatpicker', 'lessons.flatpicker')->name('lessons.flatpicker');
    Route::view('/choices', 'lessons.choices')->name('lessons.choices');
    Route::view('/quill', 'lessons.quill')->name('lessons.quill');
    Route::view('/dropzone', 'lessons.dropzone')->name('lessons.dropzone');
});
require __DIR__ . '/auth.php';
