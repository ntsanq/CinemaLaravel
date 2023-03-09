<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    public function room()
    {
        return $this->belongsTo(Seat::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function seatCategory()
    {
        return $this->belongsTo(SeatCategory::class);
    }
}
