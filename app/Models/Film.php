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

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function rule()
    {
        return $this->belongsTo(FilmRule::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
