<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function filmCategory()
    {
        return $this->hasOne(FilmCategory::class);
    }

    public function image()
    {
        return $this->hasOne(FilmCategory::class);
    }
}
