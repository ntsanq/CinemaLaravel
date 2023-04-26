<?php

namespace App\Console\Commands;

use App\Enums\SeatStatus;
use App\Models\Schedule;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RoomResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'room:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset room after showing';

    /**
     * @return void
     */
    public function handle()
    {
        $schedules = Schedule::all();

        $count = 0;
        foreach ($schedules as $schedule) {
            $now = Carbon::now();
            $end = Carbon::parse($schedule->end);

            if ($now->greaterThan($end)) {
                Seat::query()->where('room_id', $schedule->room_id)->update([
                    "status" => SeatStatus::UnBooked
                ]);
                $count++;
            }
        }

        $this->info("Finish reset seats for " . $count . " schedules");
    }
}
