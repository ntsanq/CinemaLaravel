<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $filmIds = DB::table('films')->select('id')->get();
        $roomIds = DB::table('rooms')->select('id')->whereNotIn('id', [9, 10])->get();;

        $startTime = fake()->dateTimeInInterval('now', '+ 3 days', 'Asia/Ho_Chi_Minh');
        $endTime = Carbon::parse($startTime)->addHours(2);

        return [
            'film_id' => fake()->randomElement($filmIds)->id,
            'room_id' => fake()->randomElement($roomIds)->id,
            'start' => $startTime->format('Y-m-d H:i:s'),
            'end' => $endTime->format('Y-m-d H:i:s')
        ];
    }
}
