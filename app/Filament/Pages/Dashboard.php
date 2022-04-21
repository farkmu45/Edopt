<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminStatsOverview;
use App\Filament\Widgets\AppointmentsChart;
use App\Filament\Widgets\UsersChart;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $title = 'Dasbor';
    protected static ?string $navigationLabel = 'Dasbor';
    protected static ?string $slug = 'dashboard';
    protected static string $view = 'filament.pages.dashboard';

    public function getHeaderWidgets(): array
    {
        return [
            AdminStatsOverview::class,
            UsersChart::class,
            AppointmentsChart::class
        ];
    }
}
