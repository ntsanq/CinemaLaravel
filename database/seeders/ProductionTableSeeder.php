<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Production;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productions = [
            'Thanh Sang media',
            'CTU media',
            'Ninh Kieu media'
        ];

        foreach ($productions as $production) {
            Production::create([
                'name' => $production
            ]);
        }
    }
}
