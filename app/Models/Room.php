<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function seat()
    {
        return $this->hasMany(Seat::class);
    }

}
