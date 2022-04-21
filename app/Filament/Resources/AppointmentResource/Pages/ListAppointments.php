<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAppointments extends ListRecords
{
    protected static string $resource = AppointmentResource::class;

    protected function getTableQuery(): Builder
    {
        if (auth()->user()->isMaster()) {
            return parent::getTableQuery();
        } else {
            return parent::getTableQuery()->whereRelation('child.orphanage', 'orphanage_id', '=', auth()->user()->orphanage_id);
        }
    }
}
