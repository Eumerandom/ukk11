<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\IndustriTable;
use App\Filament\Widgets\PKLOverview;
use App\Models\Industri;
use App\Models\PKL;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DashboardSiswa extends Page
{
    protected static string $view = 'filament.pages.dashboard-siswa';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $Label = 'Dashboard';
    protected static ?string $title = '';
    protected static ?string $slug = '/siswa/dashboard';

    protected static bool $hasWidgets = true;

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('siswa');
    }
    
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('siswa') || auth()->user()->hasRole('super_admin'));
    }

    protected function getHeaderWidgets(): array
    {
        $user = auth()->user();
        if (!$user || !$user->hasRole('siswa') || ($user->siswa && $user->siswa->status_pkl === 'aktif')) {
            return [];
        }

        return [
            // IndustriTable::class,
        ];
    }

    public function getViewData(): array
    {
        $user = auth()->user();
        
        if (!$user || !$user->hasRole('siswa')) {
            return [
                'siswa' => null,
                'showTable' => false
            ];
        }

        $siswa = $user->siswa;
        if (!$siswa) {
            return [
                'siswa' => null,
                'showTable' => false
            ];
        }

        return [
            'siswa' => $siswa,
            'showTable' => $siswa->status_pkl !== 'aktif'
        ];
    }
}
