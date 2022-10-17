<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(
            [
                UsersTableSeeder::class,
                DiscountTableSeeder::class,
                RoomTableSeeder::class,
                ImageTableSeeder::class,
                FilmCategoryTableSeeder::class,
                FilmTableSeeder::class,
                ScheduleTableSeeder::class,
                SeatTableSeeder::class
            ]
        );
    }
}
