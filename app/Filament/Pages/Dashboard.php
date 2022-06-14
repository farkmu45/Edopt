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

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isMaster();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isMaster(), 403);
    }

    public function getHeaderWidgets(): array
    {
        return [
            AdminStatsOverview::class,
            UsersChart::class,
            AppointmentsChart::class
        ];
    }
}
