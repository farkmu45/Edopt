<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time' => $this->time,
            'status' => $this->status,
            'orphanage' => $this->orphanage->name,
            'child' => $this->child->name,
            'latitude' =>  $this->orphanage->latitude,
            'longtitude' =>  $this->orphanage->longtitude,
        ];
    }
}
