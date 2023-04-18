<?php

namespace App\Http\Controllers\API;

use App\Enums\RoomStatus;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController
{
    public function index(Request$request)
    {
        $search = !empty($request->search) ? $request->search : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $rooms = Room::query()
            ->where('name','like', '%' . $search . '%')
            ->get();

        $roomsData = [];
        foreach ($rooms as $room) {
            if ($room['status'] === RoomStatus::Full) {
                $room['status'] = 'Full';
            } elseif ($room['status'] === RoomStatus::UnFull) {
                $room['status'] = 'Unfull';
            }
            $roomsData[] = $room;
        }

        $total = count($roomsData);
        $query = collect($roomsData)->skip($start)->take($end - $start);
        $data = array_values($query->toArray());

        return response()->json($data)->header('X-Total-Count', $total);
    }

    public function infoForAdmin($id)
    {
        $room = Room::findOrFail($id);

        return response()->json($room);
    }

    public function updateForAdmin($id, Request $request)
    {
        $room = Room::findOrFail($id);
        $room->name = $request->name;
        $room->status = $request->status;
        $room->save();

        return response()->json($room);
    }

    public function createForAdmin( Request $request)
    {
        $room = new Room();
        $room->name = $request->name;
        $room->status = $request->status;
        $room->save();

        return response()->json($room);
    }

    public function deleteForAdmin($id)
    {
//        $room = Room::findOrFail($id);
//        $room->delete();

        return response()->json(['message'=>'Can not delete Room'], 400);
    }
}
