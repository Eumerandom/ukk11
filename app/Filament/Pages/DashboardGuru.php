<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DashboardGuru extends Page
{
    protected static string $view = 'filament.pages.dashboard-guru';

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $Label = 'Dashboard';
    protected static ?string $title = '';
    protected static ?string $slug = '/guru/dashboard';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('guru');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('guru') || auth()->user()->hasRole('super_admin'));
    }

}
