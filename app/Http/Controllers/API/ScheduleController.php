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
        $start_date = !empty($request->start_date) ? $request->start_date : '';
        $room_id = !empty($request->room_id) ? $request->room_id : '';
        $film_id = !empty($request->film_id) ? $request->film_id : '';


        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $sort = $request->input('_sort', '');
        $order = $request->input('_order', '');

        $schedules = Schedule::query()
            ->join('films', 'films.id', 'schedules.film_id')
            ->join('rooms', 'rooms.id', 'schedules.room_id')
            ->select([
                'schedules.*',
                'films.name as film_name',
                'films.duration as duration'
            ])
            ->where('films.name', 'like', '%' . $search . '%')
            ->where('schedules.start', 'like', '%' . $start_date . '%')
            ->where('schedules.room_id', 'like', '%' . $room_id . '%')
            ->where('schedules.film_id', 'like', '%' . $film_id . '%')
            ->orderBy($sort, $order)
            ->get();

        $schedulesData = [];
        foreach ($schedules as $schedule) {
            $schedule['start'] = Carbon::parse($schedule['start'])->format('d-m-Y h:i A');
            $schedule['end'] = Carbon::parse($schedule['end'])->format('d-m-Y h:i A');
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

        $this->roomCheck($request->room_id, $request->start, $request->room_id, $request->film_id);

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

    private function roomCheck($roomId, $time, $idUpdateFor, $filmId): void
    {
        $film = Film::findOrFail($filmId);
        $filmDuration = $film->duration;

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
            $inputTime = Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $time)
                ->setTimezone(env('APP_TIMEZONE'));
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $roomSchedule['start']);
            $soonerDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $roomSchedule['start'])
                ->subMinutes($filmDuration);
            $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $roomSchedule['end']);
            $filmDuration = 120;

            if ($inputTime->between($soonerDateTime, $endDateTime) || $time === $startDateTime) {

                if ($roomSchedule['id'] == $idUpdateFor) {
                    continue;
                } else {
                    throw new \Exception('There is a schedule at ' . $startDateTime->format('H:i')
                        . ' to ' . $endDateTime->format('H:i')
                        . '. You have to set it before ' . $filmDuration . ' minutes.');
                }

            }
        }
    }
}
