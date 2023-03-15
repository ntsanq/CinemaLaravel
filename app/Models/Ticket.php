<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'session_id'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
