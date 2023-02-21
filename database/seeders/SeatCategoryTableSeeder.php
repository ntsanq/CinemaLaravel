<?php

namespace Database\Seeders;

use App\Models\FilmCategory;
use App\Models\SeatCategory;
use Illuminate\Database\Seeder;

class SeatCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Villager',
            'Dreamer',
        ];

        foreach ($categories as $category) {
            $seatCategoryIns = new SeatCategory();
            $seatCategoryIns->name = $category;
            if ($seatCategoryIns->name === 'Dreamer') {
                $seatCategoryIns->price = 120000;
            } else {
                $seatCategoryIns->price = 150000;
            }
            $seatCategoryIns->save();
        }
    }
}
