<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Orphanage;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class AdminStatsOverview extends BaseWidget
{
    public $orphanageCount;
    public $userCount;
    public $appointmentCount;

    public function mount()
    {
        $this->orphanageCount = Orphanage::count();
        $this->userCount = User::count();
        $this->appointmentCount = Appointment::where('status', 'SUCCEED')->count();
    }


    protected function getCards(): array
    {
        return [
            Card::make('Total Panti Asuhan', $this->orphanageCount),
            Card::make('Total Pengguna', $this->userCount),
            Card::make('Total Kunjungan Berhasil', $this->appointmentCount),
        ];
    }
}
