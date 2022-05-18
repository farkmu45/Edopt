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
                'province' => $orphanage->province->name,
                'regency' => $orphanage->regency->name,
                'district' => $orphanage->district->name,
                'opening_hours' => $orphanage->opening_hours,
                'closing_hours' => $orphanage->closing_hours,
            ]
        );
    }
}
