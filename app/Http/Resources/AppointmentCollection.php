<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AppointmentCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($appointment) => [
                'id' => $appointment->id,
                'time' => $appointment->time,
                'status' => $appointment->status,
                'orphanage' => $appointment->orphanage->name,
                'child' => $appointment->child->name,
                'latitude' =>  $appointment->orphanage->latitude,
                'longitude' =>  $appointment->orphanage->longitude,
            ]
        );
    }
}
