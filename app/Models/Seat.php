<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'seat_id', 'id');
    }

    public function room()
    {
        return $this->hasOne(Seat::class);
    }
}
