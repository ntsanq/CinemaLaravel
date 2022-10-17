<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'gender' => fake()->randomElement(['0', '1']),
            'birthday' => fake()->dateTimeBetween('-50 years','-18 years'),
            'email_verified_at' => now(),
            'password' => '$2a$12$ZgHrwmrUnKZLRkzbw4zQBOd96.PI.uTKkIo2P90lEIW1DTEA25YpW', // password
            'address' => fake()->address(),
            'avatar' => fake()->imageUrl('100','100'),
            'role' => fake()->randomElement(UserRole::getValues()),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
