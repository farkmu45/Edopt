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
        // $lat = $request->input('lat');
        // $lng = $request->input('lng');
        // $minAge = $request->input('min_age') ?? 1;
        // $maxAge = $request->input('max_age') ?? 20;
        // $gender = $request->input('gender') ?? '';

        // Limit child location to 40 km
        return new ChildCollection(Child::latest()->get());
    }

    public function getById(Child $child)
    {
        return new ChildResource($child);
    }
}
