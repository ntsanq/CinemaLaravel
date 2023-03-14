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
            'Over 18 only',
            'Over 16 only',
            'No cat',
            'No dog',
            'Only elderly',
        ];

        foreach ($filmRules as $filmRule) {
            FilmRule::create([
                'name' => $filmRule
            ]);
        }
    }
}
