<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AppointmentsChart extends LineChartWidget
{
    protected static ?string $heading = 'Statistik Kunjungan';

    protected function getData(): array
    {
        $data = Trend::model(Appointment::class)->between(start: now()->startOfMonth(), end: now()->endOfMonth())->perDay()->count();


        return [
            'datasets' => [
                [
                    'label' => 'Kunjungan',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ]
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date)
        ];
    }
}
