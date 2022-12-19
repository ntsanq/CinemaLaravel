<?php

namespace App\Http\Controllers\API;

use App\Enums\SeatStatus;
use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    use ResponseTrait;

    public function get(Request $request)
    {
        $seats = Seat::query()->where('room_id', $request->room_id)->get();

        foreach ($seats as $seat) {
            if ($seat->status === SeatStatus::UnBooked) {
                $available[] = $seat;
            }
            if ($seat->status === SeatStatus::Booked) {
                $booked[] = $seat;
            }
        }

        return $this->success([
            'booked' => $booked,
            'available' => $available
        ]);
    }
}
