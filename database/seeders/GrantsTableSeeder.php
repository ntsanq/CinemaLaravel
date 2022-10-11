<?php

namespace Database\Seeders;

use App\Models\Grant;
use Illuminate\Database\Seeder;

class GrantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grant::create([
            'name' => 'Admin',
        ]);
        Grant::create([
            'name' => 'Clerk',
        ]);
        Grant::create([
            'name' => 'Customer',
        ]);
    }
}
