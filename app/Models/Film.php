<?php

namespace App\Models;

use App\Enums\TypeFilm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Str;

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

    protected static function boot(): void
    {
        parent::boot();
        static::creating(static function ($model) {
            $model->slug = Str::slug($model->title);
            $model->url_film = "https://iframe.mediadelivery.net/embed/110856/". $model->url_film."?autoplay=true";
            $model->url_trailer = "https://iframe.mediadelivery.net/embed/110856/". $model->url_trailer."?autoplay=true";
        });
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id', 'film_id');
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(FilmGallery::class);
    }

    public function actors(): HasMany
    {
        return $this->hasMany(ActorFilm::class);
    }

    public function information(): HasMany
    {
        return $this->hasMany(FilmDetail::class);
    }

    public function filmGenre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'film_genres', 'film_id', 'genre_id');
    }

    public function filmView(): HasMany
    {
        return $this->hasMany(FilmView::class);
    }

    public function filmSelling(): BelongsTo
    {
        return $this->belongsTo(FilmSelling::class, 'id', 'film_id');
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Whislist::class);
    }
}
