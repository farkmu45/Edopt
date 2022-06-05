<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function getAll()
    {
        // TODO get by user ID from token

        return new AppointmentCollection(Appointment::where('user_id', 2)->get());
    }

    public function getById(Appointment $appointment)
    {
        // TODO authorize by using user_id

        return new AppointmentResource($appointment);
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'time' => 'date|required',
                'child_id' => 'exists:children,id|required',
            ]
        );

        $data['user_id'] = 2;

        return new AppointmentResource(Appointment::create($data));
    }
}
