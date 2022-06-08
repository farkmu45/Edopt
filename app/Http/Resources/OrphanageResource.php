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
            'image_url' => asset('/storage/' . $this->image_url),
            'province' => ucwords(strtolower($this->province->name)),
            'regency' =>  ucwords(strtolower($this->regency->name)),
            'district' => ucwords(strtolower($this->district->name)),
            'address' => $this->address,
            'opening_hours' => $this->opening_hours,
            'closing_hours' => $this->closing_hours,
        ];
    }
}
