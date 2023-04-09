<?php

namespace App\DataTransferObjects;

use App\Enums\TypeFilm;
use Illuminate\Http\Request;

class FilmDto
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?int $filmId = null,
        public readonly ?string $slug  = null,
        public readonly ?string $description  = null,
        public readonly ?string $image  = null,
        public readonly ?string $trailer  = null,
        public readonly ?string $release_date  = null,
        public readonly ?string $duration  = null,
        public readonly ?string $rating  = null,
        public readonly ?string $status = null,
        public readonly ?TypeFilm $type = null,
        public readonly ?string $genre = null,
        public readonly ?int $perPage = null,
        public readonly ?int $page = null,
    ) {}

    public static function fromFilmGenre(Request $request, string  $slug): FilmDto
    {
        return new self(
            genre: $slug,
            perPage: $request->per_page,
            page: $request->page,
        );
    }

    public static function fromRelatedFilm(array $request): FilmDto
    {
        return new self(
            filmId: $request['filmId'],
            genre: $request['genre'],
            perPage: $request['per_page']?? 1,
            page: $request['page']?? 1,
        );
    }
}
