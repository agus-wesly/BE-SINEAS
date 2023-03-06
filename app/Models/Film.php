<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function gallery()
    {
        return $this->hasMany(FilmGallery::class);
    }

    public function actors()
    {
        return $this->hasMany(ActorFilm::class);
    }
}
