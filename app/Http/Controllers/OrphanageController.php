<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrphanageCollection;
use Algolia\AlgoliaSearch\SearchIndex;
use App\Models\Orphanage;
use Illuminate\Http\Request;

class OrphanageController extends Controller
{
    public function search(Request $request)
    {
        if ($request->has('query') && $request->has('lat') && $request->has('lng')) {
            $lat = $request->input('lat');
            $lng = $request->input('lng');
            $query = $request->input('query') ?? '';

            // Around precision groups location based on linear number (10000 - 19999, 20000 - 29999)

            return new OrphanageCollection(Orphanage::search(
                $query,
                function (SearchIndex $algolia, string $query, array $options) use ($lat, $lng) {
                    $options['aroundLatLng'] = "$lat, $lng";
                    $options['aroundPrecision'] = 10000;
                    return $algolia->search($query, $options);
                }
            )->paginate(10));
        }
    }
}
