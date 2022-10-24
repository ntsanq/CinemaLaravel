<?php

namespace Database\Seeders;

use App\Models\FilmRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filmRules = [
            'No Under 18',
            'No Under 13'
        ];

        foreach ($filmRules as $filmRule) {
            FilmRule::create([
                'name' => $filmRule
            ]);
        }
    }
}
