<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use Filament\Resources\Pages\CreateRecord;

class CreateChild extends CreateRecord
{
    protected static string $resource = ChildResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->user()->isMaster) {
            return $data;
        }

        $data['orphanage_id'] = auth()->user()->orphanage_id;
        return $data;
    }
}
