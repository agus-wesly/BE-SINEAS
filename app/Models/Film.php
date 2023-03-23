<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Film extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = \Str::slug($model->title);
        });
    }

    public function gallery()
    {
        return $this->hasMany(FilmGallery::class);
    }

    public function actors()
    {
        return $this->hasMany(ActorFilm::class);
    }

    public function information()
    {
        return $this->hasMany(FilmDetail::class);
    }

    public function filmGenre()
    {
        return $this->belongsToMany(FilmGenre::class, 'film_genres', 'film_id', 'genre_id');
    }

    public function filmView()
    {
        return $this->hasMany(FilmView::class);
    }

    public function filmSelling(): BelongsTo
    {
        return $this->belongsTo(FilmSelling::class, 'id', 'film_id');
    }
}
