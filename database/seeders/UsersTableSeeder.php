<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => "Lãng Tử",
            'email' => "sangss998@gmail.com",
            'gender' => 1,
            'birthday' => "2000-01-24",
            'email_verified_at' => now(),
            'password' => '$2a$12$ZgHrwmrUnKZLRkzbw4zQBOd96.PI.uTKkIo2P90lEIW1DTEA25YpW', // password 123
            'address' => "Vi Thanh - Hau Giang",
            'avatar' => fake()->imageUrl('100','100'),
            'role' => 2,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Thanh Sang",
            'email' => "admin@gg.com",
            'gender' => 1,
            'birthday' => "2000-01-24",
            'email_verified_at' => now(),
            'password' => '$2a$12$ZgHrwmrUnKZLRkzbw4zQBOd96.PI.uTKkIo2P90lEIW1DTEA25YpW', // password 123
            'address' => "Vi Thanh - Hau Giang",
            'avatar' => fake()->imageUrl('100','100'),
            'role' => 0,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Thanh Sang",
            'email' => "clerk@gg.com",
            'gender' => 1,
            'birthday' => "2000-01-24",
            'email_verified_at' => now(),
            'password' => '$2a$12$ZgHrwmrUnKZLRkzbw4zQBOd96.PI.uTKkIo2P90lEIW1DTEA25YpW', // password 123
            'address' => "Vi Thanh - Hau Giang",
            'avatar' => fake()->imageUrl('100','100'),
            'role' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::factory(20)->create();
    }
}
