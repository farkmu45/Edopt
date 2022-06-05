<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChildCollection;
use App\Http\Resources\ChildResource;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function getAll(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $minAge = $request->input('min_age') ?? 1;
        $maxAge = $request->input('max_age') ?? 20;
        $gender = $request->input('gender') ?? '';

        // Limit child location to 40 km
        return new ChildCollection(Child::search()
            ->whereBetween('age', [$minAge, $maxAge])
            ->where('is_adopted', 0)
            ->aroundLatLng($lat, $lng)
            ->with([
                'facetFilters' => 'gender:'.$gender,
                'aroundRadius' => 40000,
            ]));
    }

    public function getById(Child $child)
    {
        return new ChildResource($child);
    }
}
