<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function filmCategory()
    {
        return $this->belongsTo(FilmCategory::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
