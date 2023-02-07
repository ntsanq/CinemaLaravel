<?php

namespace App\Http\Controllers\API;

use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;

class BookingController
{
    public function getSeats(Request $request)
    {


        $schedules = Schedule::query()
            ->join('rooms', 'rooms.id', 'schedules.room_id')
            ->select([
                'schedules.*',
                'rooms.*'
            ])
            ->where('schedules.film_id', $request->filmId)
            ->where('schedules.deleted_at', null)->get()->toArray();

        $rooms = [];
        foreach ($schedules as $schedule) {
            $seats = Seat::query()
                ->where('room_id', $schedule['room_id'])
                ->get();
            $seats = $seats->makeHidden([
                'id',
                'room_id',
                'created_at',
                'updated_at',
                'deleted_at',
            ]);
            $rooms[$schedule['name']] = $seats->toArray();
        }

        return response()->json([
            'success' => true,
            'data' => [
                $rooms
            ]
        ]);
    }

    public function getTimes(Request $request)
    {

    }
}
