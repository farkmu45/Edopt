<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\AppointmentResource;
use App\Models\Child;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data['status'] == 'SUCCESS') {
            $child = Child::find($record->child_id);
            $child->is_adopted = true;
            $child->save();
        }

        $record->update($data);
        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
