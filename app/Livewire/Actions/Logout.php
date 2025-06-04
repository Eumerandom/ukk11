<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        auth()->guard('web')->logout();
        // auth()->guard('filament')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/login');
        // return redirect('/sija/login');
    }
}
