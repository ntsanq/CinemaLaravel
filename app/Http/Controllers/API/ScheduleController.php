<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Schedule;
use Carbon\Carbon;
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
        $schedule = Schedule::query()
            ->join('films', 'films.id', 'schedules.film_id')
            ->select([
                'schedules.*',
                'films.name as film_name',
                'films.id as film_id',
            ])
            ->where('schedules.id', $id)
            ->first();
        $schedule['duration'] = $this->durationCalculate($schedule->id, 'int');
        return response()->json($schedule);
    }

    public function updateForAdmin($id, Request $request)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->film_id = $request->film_id;
        $schedule->room_id = $request->room_id;

        $time_start = Carbon::parse($request->start)->format('H:i');
        $date_start = Carbon::parse($request->start_time)->format('Y-m-d');
        $startTime = $date_start . " " . $time_start;
        $startTime = Carbon::parse($startTime);
        $endTime = $startTime->copy()->addMinutes($request->duration);

        $schedule->start = $startTime;
        $schedule->end = $endTime;

        $schedule->save();

        return response()->json($schedule);
    }

    public function createForAdmin(Request $request)
    {
        $time_start = Carbon::parse($request->start)->format('H:i');
        $date_start = Carbon::parse($request->start_time)->format('Y-m-d');
        $startTime = $date_start . " " . $time_start;
        $startTime = Carbon::parse($startTime);
        $endTime = $startTime->copy()->addMinutes($request->duration);

        $schedule = new Schedule();
        $schedule->film_id = $request->film_id;
        $schedule->room_id = $request->room_id;
        $schedule->start = $startTime;
        $schedule->end = $endTime;

        $schedule->save();

        return response()->json($schedule);
    }

    public function deleteForAdmin($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json("Deleted");
    }
}
