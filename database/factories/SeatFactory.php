<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roomIds = DB::table('rooms')->select('id')->get();

        return [
            'room_id' => fake()->randomElement($roomIds)->id,
            'name' => fake()->unique()->randomElement()
        ];
    }
}
