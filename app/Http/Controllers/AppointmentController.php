<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPostRequest;
use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function getAll()
    {
        return new AppointmentCollection(Appointment::where('user_id', auth()->user()->id)
            ->latest()->paginate(5));
    }

    public function getById(Appointment $appointment)
    {
        return new AppointmentResource($appointment);
    }

    public function create(AppointmentPostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $parsedDate = Carbon::parse($data['time']);
        $date = $parsedDate->format('Y-m-d');

        $time = Carbon::createFromTimeString($parsedDate->format('H:i'));

        $orphanage = Child::find($data['child_id'])->orphanage;
        $open = Carbon::createFromTimeString($orphanage->opening_hours);
        $close = Carbon::createFromTimeString($orphanage->closing_hours);

        if (!$time->between($open, $close)) {
            throw (ValidationException::withMessages([
                'time' => 'Waktu janji temu harus diantara jam buka/tutup panti asuhan'
            ]));
        }

        $appointments = Appointment::where('child_id', '=', $data['child_id'])
            ->whereDate('time', '=', $date)
            ->get();

        if (!$appointments->isEmpty()) {
            throw (ValidationException::withMessages([
                'time' => 'Anak hanya boleh bertemu sebanyak sekali perhari'
            ]));
        }
        return new AppointmentResource(Appointment::create($data));
    }
}
