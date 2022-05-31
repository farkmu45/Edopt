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
                'district' => ucwords(strtolower($orphanage->district->name)),
                'opening_hours' => $orphanage->opening_hours,
                'closing_hours' => $orphanage->closing_hours,
            ]
        );
    }
}
