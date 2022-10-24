<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_category_id',
        'image_id',
        'name',
        'description',
        'language_id',
        'film_rule_id',
    ];

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

    public function filmRule()
    {
        return $this->belongsTo(FilmRule::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->fillable, $value));
    }
}
