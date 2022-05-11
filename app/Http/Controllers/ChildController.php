<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChildResource;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function getById(Child $child)
    {
        return new ChildResource($child);
    }
}
