<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrphanageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_url' => $this->image_url,
            'province' => $this->province->name,
            'regency' => $this->regency->name,
            'district' => $this->district->name,
            'address' => $this->address,
            'opening_hours' => $this->opening_hours,
            'closing_hours' => $this->closing_hours,
        ];
    }
}
