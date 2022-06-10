<?php

namespace App\Filament\Resources\OrphanageResource\Pages;

use App\Filament\Resources\OrphanageResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditOrphanage extends EditRecord
{
    protected static string $resource = OrphanageResource::class;


    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data['image_url'] != $record['image_url']) {
            Storage::delete('public/' . $record['image_url']);
        }

        $record->update($data);

        return $record;
    }
}
