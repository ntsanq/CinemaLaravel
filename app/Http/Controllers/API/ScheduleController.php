<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::query()
            ->get()->toArray();

        $data = [];
        foreach ($schedules as $schedule) {
            $schedule['duration'] = $this->durationCalculate($schedule['id'], "int");
            $data[] = $schedule;
        }

        return response()->json($data)->header('X-Total-Count', count($data));
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

    public function createForAdmin(Request $request)
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

        return response()->json(['message' => 'Can not delete Room'], 400);
    }
}
