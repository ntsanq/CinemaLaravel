<?php

namespace App\Http\Controllers\API;

use App\Enums\SeatStatus;
use App\Http\Traits\ResponseTrait;
use App\Models\Seat;
use App\Models\SeatCategory;
use Illuminate\Http\Request;

class SeatController
{
    use ResponseTrait;

    public function info(Seat $id)
    {
        $data = $id->toArray();
        if ($id->status === SeatStatus::UnBooked) {
            $data['status'] = 'Available';
        } else {
            $data['status'] = 'Unavailable';
        }

        unset($data['created_at'], $data['deleted_at'], $data['updated_at'], $data['seat_category_id']);

        $seatCategory = SeatCategory::findOrFail($id->seat_category_id);

        $data['price'] = $seatCategory->price;
        $data['seat_type'] = $seatCategory->name;

        return $this->success($data);
    }

    public function getCoupleSeat(Request $request)
    {
        $coupleSeats = [
            ['1J', '2J'],
            ['3J', '4J'],
            ['5J', '6J'],
            ['7J', '8J']
        ];

        $seat = Seat::query()
            ->where('id', $request->seatId)
            ->first();

        if ($this->isCoupleSeat($seat, $coupleSeats)){
            $neededSeatName = '';
            foreach ($coupleSeats as $seats) {
                if (in_array($seat->name, $seats)) {
                    $seatIndex = array_search($seat->name, $seats);
                    $adjacentSeatIndex = ($seatIndex == 0) ? 1 : 0;
                    $neededSeatName = ($seats[$adjacentSeatIndex]);
                }
            }

            $neededSeat = Seat::query()
                ->where('room_id', $seat->room_id)
                ->where('name', $neededSeatName)
                ->first()->toArray();

            return $this->success($neededSeat);
        }

        return $this->failed('the seat is not for this function');
    }

    private function isCoupleSeat($seat, $coupleSeats): bool
    {
        $coupleSeatsCollection = collect($coupleSeats);
        return $coupleSeatsCollection->contains(function ($couple) use ($seat) {
            return in_array($seat->name, $couple);
        });
    }
}
