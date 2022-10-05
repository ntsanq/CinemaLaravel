<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
}
