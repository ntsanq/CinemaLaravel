<?php

namespace Database\Seeders;

use App\Models\FilmCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Horror',
            'Romantic',
            'Action',
            'Cartoon'
        ];

        foreach ($categories as $category) {
            FilmCategory::create([
                'name' => $category
            ]);
        }
    }
}
