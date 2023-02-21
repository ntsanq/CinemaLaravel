<?php

namespace Database\Seeders;

use App\Enums\SeatStatus;
use App\Models\Seat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatTableSeeder extends Seeder
{

    const VILLAGER = 1;
    const DREAMER = 2;


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
            'H',
            'J'
        ];

        $seats = [];
        foreach ($chars as $char) {
            for ($i = 1; $i <= 8; $i++) {
                $seatName = $i . $char;
                $seats[] = $seatName;
            }
        }

        $rooms = DB::table('rooms')->select('id')->get();

        $vipSeatsList = [
            '1J',
            '2J',
            '3J',
            '4J',
            '5J',
            '6J',
            '7J',
            '8J',
        ];

        foreach ($rooms as $room) {
            foreach ($seats as $seat) {
                $seatIns = new Seat();
                $seatIns->room_id = $room->id;
                $seatIns->name = $seat;
                if (in_array($seatIns->name, $vipSeatsList)) {
                    $seatIns->seat_category_id = self::VILLAGER;
                } else {
                    $seatIns->seat_category_id = self::DREAMER;
                }
                $seatIns->status = fake()->randomElement(SeatStatus::getValues());
                $seatIns->save();
            }
        }
    }
}
