<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use Filament\Resources\Pages\EditRecord;

class EditChild extends EditRecord
{
    protected static string $resource = ChildResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (auth()->user()->isMaster()) {
            return $data;
        }

        $data['orphanage_id'] = auth()->user()->orphanage_id;
        return $data;
    }
}
