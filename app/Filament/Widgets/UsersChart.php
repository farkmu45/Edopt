<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersChart extends LineChartWidget
{
    protected static ?string $heading = 'Statistik Pengguna';

    protected function getData(): array
    {

        $data = Trend::model(User::class)->between(start: now()->startOfMonth(), end: now()->endOfMonth())->perDay()->count();


        return [
            'datasets' => [
                [
                    'label' => 'Pengguna',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ]
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date)
        ];
    }
}
