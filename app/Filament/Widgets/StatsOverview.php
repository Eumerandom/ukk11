<?php

namespace App\Filament\Widgets;

use App\Models\PKL;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Industri;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total PKL', value: PKL::count())
                ->icon('heroicon-o-briefcase')
                // ->color('primary')
                ->description('Total PKL terdaftar')
                ->chart([7, 2, 5, 15, 20])
                ->color('success'),
            Stat::make('Total Siswa', Siswa::count())
                ->icon('heroicon-o-user')
                ->color('primary')
                ->description('Total Siswa tercatat')
                ->chart([20, 15, 7, 2, 10]),
            Stat::make('Total Industri', Industri::count())
                ->icon('heroicon-o-building-office-2')
                ->color('warning')
                ->description('Industri yang Bermitra')
                ->chart([10, 15, 7, 2, 15]),
            Stat::make('Total Guru', Guru::count())
                ->icon('heroicon-o-academic-cap')
                ->color('danger')
                ->description('Total Guru Pembimbing')
                ->chart([15, 17, 10, 2, 7]),
        ];
    }
}
