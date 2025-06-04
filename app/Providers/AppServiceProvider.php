<?php

namespace App\Providers;

use App\Http\Responses\LogoutResponse;
use App\Models\Guru;
use App\Models\PKL;
use App\Models\Siswa;
use App\Models\User;
use App\Observers\GuruObserver;
use App\Observers\PKLObserver;
use App\Observers\SiswaObserver;
use App\Observers\UserObserver;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // User::observe(UserObserver::class);
        // Siswa::observe(SiswaObserver::class);
        // Guru::observe(GuruObserver::class);
        PKL::observe(PKLObserver::class);
    }
}
