<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Schedule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function durationCalculate($id)
    {
        $filmSchedule = Schedule::query()
            ->where('film_id', $id)
            ->get()
            ->first();

        if ($filmSchedule === null) {
            return 'No schedule yet';
        }
        $filmSchedule = $filmSchedule->toArray();

        $startTime = Carbon::parse($filmSchedule['start']);
        $finishTime = Carbon::parse($filmSchedule['end']);


        return $finishTime->diffInMinutes($startTime).' minutes';
    }
}
