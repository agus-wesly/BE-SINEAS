<?php

namespace App\Models;

use App\Enums\TypeFilm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Film extends Model
{
    use HasFactory;
    use searchable;

    public function searchableAs(): string
    {
        return 'posts_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'title' =>  $this->title,
        ];
    }

    protected $casts = [
        'type' => TypeFilm::class,
    ];

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
        return $this->belongsToMany(Genre::class, 'film_genres', 'film_id', 'genre_id');
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
