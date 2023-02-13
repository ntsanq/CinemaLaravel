<?php

namespace App\Http\Controllers\API;

use App\Http\Traits\ResponseTrait;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController
{
    use ResponseTrait;

    public function getSeats(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'roomId' => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        $seats = Seat::query()
            ->join('rooms', 'rooms.id', 'seats.room_id')
            ->select([
                'seats.id',
                'seats.name',
                'seats.status',
                'seats.price',
            ])
            ->where('seats.room_id', $request->roomId)
            ->get()->toArray();

        return $this->success($seats);
    }

    public function getTimes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filmId' => 'required|int',
            'date' => 'required|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        $date = strtotime($request->date);

        $schedules = Schedule::query()
            ->join('films', 'films.id', 'schedules.film_id')
            ->select([
                'schedules.start',
                'schedules.end',
                'schedules.room_id',
            ])
            ->where('schedules.film_id', $request->filmId)
            ->whereDate('schedules.start', date('Y/m/d', $date))
            ->get()->toArray();

        if ($schedules === null) {
             return $this->successMessage([]);
        }

        foreach ($schedules as &$schedule) {
            $schedule['start'] = date('H:i', strtotime($schedule['start']));
            $schedule['end'] = date('H:i', strtotime($schedule['end']));
        }

        return $this->success($schedules);
    }
}
