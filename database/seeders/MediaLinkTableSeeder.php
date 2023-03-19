<?php

namespace Database\Seeders;

use App\Enums\MediaLinks;
use App\Models\MediaLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaLinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trailerKeys = MediaLinks::TrailerKeys;
        $imageLinks = MediaLinks::ImageLinks;

        for ($i = 0; $i < count($trailerKeys); $i++) {
            MediaLink::create([
                'image_link' => $imageLinks[$i],
                'trailer_link' => "https://www.youtube.com/embed/" . $trailerKeys[$i]
            ]);
        }

    }
}
