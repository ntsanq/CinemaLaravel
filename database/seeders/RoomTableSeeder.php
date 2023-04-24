<?php

namespace Database\Seeders;

use App\Enums\RoomStatus;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $letters = ['A'];

        for ($i = 1; $i <= 10; $i++) {
            Room::create([
                'name' => 'Room ' . $i,
                'status' => fake()->randomElement(RoomStatus::getValues()),
            ]);
        }
    }
}
