<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrphanageCollection;
use Algolia\AlgoliaSearch\SearchIndex;
use App\Http\Resources\OrphanageResource;
use App\Models\Orphanage;
use Illuminate\Http\Request;

class OrphanageController extends Controller
{
    public function search(Request $request)
    {
        if ($request->has('lat') && $request->has('lng')) {
            $lat = $request->input('lat');
            $lng = $request->input('lng');
            $query = $request->input('query') ?? '';

            // Around precision groups location based on linear number (10000 - 19999, 20000 - 29999)

            return new OrphanageCollection(Orphanage::search($query)
            ->aroundLatLng($lat, $lng)
            ->with([
                'aroundPrecision' => 10000,
            ]));
        }
    }

    public function getById(Orphanage $orphanage)
    {
        return new OrphanageResource($orphanage);
    }
}
