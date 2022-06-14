<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListChildren extends ListRecords
{
    protected static string $resource = ChildResource::class;

    protected function getTableQuery(): Builder
    {
        if (auth()->user()->isMaster()) {
            return parent::getTableQuery();
        } else {
            return parent::getTableQuery()->where('orphanage_id', '=', auth()->user()->orphanage_id);
        }
    }
}
