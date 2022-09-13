<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function film()
    {
        return $this->hasOne(Film::class);
    }
}
