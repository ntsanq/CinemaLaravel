<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Film;
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
                'films.duration as duration',
                'rooms.name as room_name'
            ])
            ->where('films.name', 'like', '%' . $search . '%')
            ->orWhere('rooms.name', 'like', '%' . $search . '%')
            ->get();

        $schedulesData = [];
        foreach ($schedules as $schedule) {
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
                'films.duration as duration',
            ])
            ->where('schedules.id', $id)
            ->first();

        return response()->json($schedule);
    }

    public function updateForAdmin($id, Request $request)
    {
        $this->roomCheck($request->room_id, $request->start, $id);

        $schedule = Schedule::query()
            ->join('films', 'films.id', 'schedules.film_id')
            ->select([
                'schedules.*',
                'films.name as film_name',
                'films.id as film_id',
                'films.duration as duration',
            ])
            ->where('schedules.id', $id)
            ->first();

        $schedule->film_id = $request->film_id;
        $schedule->room_id = $request->room_id;

        $startTime = Carbon::parse($request->start)->setTimezone(env('APP_TIMEZONE'));;
        $endTime = $startTime->copy()->addMinutes($schedule->duration);

        $schedule->start = $startTime;
        $schedule->end = $endTime;

        $schedule->save();

        return response()->json($schedule);
    }

    public function createForAdmin(Request $request)
    {
        $filmIns = Film::findOrFail($request->film_id);
        $startTime = Carbon::parse($request->start)->setTimezone(env('APP_TIMEZONE'));;
        $endTime = $startTime->copy()->addMinutes($filmIns->duration);

        $schedule = new Schedule();
        $schedule->film_id = $filmIns->id;

        $this->roomCheck($request->room_id, $request->start, $request->room_id);

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

    private function roomCheck($roomId, $time, $idUpdateFor): void
    {
        $roomSchedules = Schedule::query()
            ->join('rooms', 'rooms.id', 'schedules.room_id')
            ->select([
                'schedules.*',
                'rooms.id as room_id',
                'rooms.name as room_name',
            ])
            ->where('room_id', $roomId)
            ->get()->toArray();

        foreach ($roomSchedules as $roomSchedule) {
            $inputTime = Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $time)->setTimezone(env('APP_TIMEZONE'));
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $roomSchedule['start']);
            $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $roomSchedule['end']);

            if ($inputTime->between($startDateTime, $endDateTime) || $time === $startDateTime
                || $time === $startDateTime) {

                if ($roomSchedule['id'] == $idUpdateFor) {
                    continue;
                } else {
                    throw new \Exception('This room is not available from ' . $startDateTime->format('H:i') . ' to ' . $endDateTime->format('H:i'));
                }

            }
        }
    }
}
