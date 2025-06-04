<?php

use App\Livewire\Dashboard;
use App\Livewire\Industris;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    // return redirect('/sija');
    return redirect('/login');
// });
})->name('home');


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Route::get('/industri', Industris::class);
    // Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::middleware(['check.role'])->group(function () {
    Route::get('/dashboard', App\Livewire\Siswa\Dashboard::class)->name('dashboard');
    Route::get('/daftar-industri', App\Livewire\Siswa\DaftarPkl::class)->name('daftar-industri');
});


require __DIR__ . '/auth.php';
