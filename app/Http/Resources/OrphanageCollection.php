<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrphanageCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($orphanage) => [
                'id' => $orphanage->id,
                'name' => $orphanage->name,
                'opening_hours' => $orphanage->opening_hours,
                'closed_hours' => $orphanage->closed_hours,
            ]
        );
    }
}
