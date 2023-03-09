<?php

namespace App\Http\Controllers\API;

use App\Enums\SeatStatus;
use App\Http\Traits\ResponseTrait;
use App\Models\Seat;
use App\Models\SeatCategory;

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
}
