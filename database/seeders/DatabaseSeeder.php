<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(
            [
                ProductionTableSeeder::class,
                UsersTableSeeder::class,
                DiscountTableSeeder::class,
                RoomTableSeeder::class,
                MediaLinkTableSeeder::class,
                FilmCategoryTableSeeder::class,
                SeatCategoryTableSeeder::class,
                LanguagesTableSeeder::class,
                FilmRulesTableSeeder::class,
                FilmTableSeeder::class,
                ScheduleTableSeeder::class,
                SeatTableSeeder::class
            ]
        );
    }
}
