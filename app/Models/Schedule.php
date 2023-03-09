<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

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
