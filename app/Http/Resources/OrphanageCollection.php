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
                'image_url' => asset('storage/'.$orphanage->image_url),
                'province' => ucwords(strtolower($orphanage->province->name)),
                'regency' =>  ucwords(strtolower($orphanage->regency->name)),
                'district' => ucwords(strtolower($orphanage->district->name)),
                'address' => $orphanage->address,
                'opening_hours' => $orphanage->opening_hours,
                'closing_hours' => $orphanage->closing_hours,
            ]
        );
    }
}
