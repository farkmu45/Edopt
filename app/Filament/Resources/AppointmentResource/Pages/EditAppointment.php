<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use App\Models\Child;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['status'] == 'SUCCEED') {

            $child = Child::find($data['child_id']);
            $child->is_adopted = true;
            $child->save();
        }

        return $data;
    }
}
