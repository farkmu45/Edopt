<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChildCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($child) => [
                'id' => $child->id,
                'name' => $child->name,
                'orphanage_name' => $child->orphanage->name,
                'gender' => $child->gender,
                'age' => $child->age,
                'additional_info' => $child->additional_info,
            ]
        );
    }
}
