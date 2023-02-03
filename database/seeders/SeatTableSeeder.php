<?php

namespace Database\Seeders;

use App\Enums\SeatStatus;
use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chars = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H'
        ];

        $seats = [];
        foreach ($chars as $char) {
            for ($i = 1; $i <= 9; $i++) {
                $seatName = $i . $char;
                $seats[] = $seatName;
            }
        }

        $rooms = DB::table('rooms')->select('id')->get();
        foreach ($rooms as $room) {
            foreach ($seats as $seat) {
                Seat::create([
                    'room_id' => $room->id,
                    'name' => $seat,
                    'status' => fake()->randomElement(SeatStatus::getValues()),
                    'price' => fake()->numberBetween('100000', '200000')
                ]);
            }
        }
    }
}
