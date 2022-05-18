<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'orphanage_name' => $this->orphanage->name,
            'gender' => $this->gender,
            'age' => $this->age,
            'additional_info' => $this->additional_info,
            'is_adopted' => $this->is_adopted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
