<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function shedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function seat()
    {
        return $this->hasOne(Seat::class);
    }
}
