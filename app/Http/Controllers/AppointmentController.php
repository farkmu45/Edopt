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

        return new AppointmentCollection(Appointment::where('user_id', 2)->paginate(5));
    }

    public function getById(Appointment $appointment)
    {
         // TODO authorize by using user_id

        return new AppointmentResource($appointment);
    }
}
