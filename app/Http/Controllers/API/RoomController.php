<?php

namespace App\Http\Controllers\API;

use App\Enums\RoomStatus;
use App\Models\Room;

class RoomController
{
    public function index()
    {
        $rooms = Room::query()
            ->get()->toArray();

        $roomsData = [];
        foreach ($rooms as $room) {
            if ($room['status'] === RoomStatus::Full) {
                $room['status'] = 'Full';
            } elseif ($room['status'] === RoomStatus::UnFull) {
                $room['status'] = 'Unfull';
            }
            $roomsData[] = $room;
        }

        return response()->json($roomsData)->header('X-Total-Count', count($roomsData));
    }
}
