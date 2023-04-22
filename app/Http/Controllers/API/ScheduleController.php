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
        $search = !empty($request->search) ? $request->search : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $schedules = Schedule::query()
            ->join('films', 'films.id', 'schedules.film_id')
            ->join('rooms', 'rooms.id', 'schedules.room_id')
            ->select([
                'schedules.*',
                'films.name as film_name',
                'rooms.name as room_name'
            ])
            ->where('films.name', 'like', '%' . $search . '%')
            ->orWhere('rooms.name', 'like', '%' . $search . '%')
            ->get();

        $schedulesData = [];
        foreach ($schedules as $schedule) {
            $schedule['duration'] = $this->durationCalculate($schedule['id'], "int");
            $schedulesData[] = $schedule;
        }
        $total = count($schedulesData);
        $query = collect($schedulesData)->skip($start)->take($end - $start);
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
