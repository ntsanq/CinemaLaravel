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
            'Standard',
            'Premium Couple',
        ];

        foreach ($categories as $category) {
            $seatCategoryIns = new SeatCategory();
            $seatCategoryIns->name = $category;
            if ($seatCategoryIns->name === 'Standard') {
                $seatCategoryIns->price = 120000;
            } else {
                $seatCategoryIns->price = 150000;
            }
            $seatCategoryIns->save();
        }
    }
}
