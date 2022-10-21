<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            'English',
            'France',
            'Vietnamese',
            'Korean'
        ];

        foreach ($languages as $language) {
            Language::create([
                'name' => $language
            ]);
        }
    }
}
