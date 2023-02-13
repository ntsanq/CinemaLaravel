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
                'rooms.id as room_id',
                'rooms.name as room_name',
                'seats.id',
                'seats.name',
                'seats.status',
                'seats.price',
            ])
            ->where('seats.room_id', $request->roomId)
            ->get()->toArray();

        $occupiedList = [];
        $room = [];
        $allSeats = [];

        $room['id'] = $seats[0]['room_id'];
        $room['name'] = $seats[0]['room_name'];

        foreach ($seats as $seat) {
            if ($seat['status'] === 1) {
                $occupiedList[] = $seat['id'];
            }

            $allSeats[] = $seat['id'];

        }

        return $this->success([
            'allSeats' => $allSeats,
            'occupied' => $occupiedList,
            'room' => $room,
        ]);
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
