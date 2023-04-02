<?php

namespace App\Repository\genre;

use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreRepository implements IGenreRepository
{
    private Genre $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function getAllGenres(): object
    {
        return GenreResource::collection($this->genre->all());
    }

    public function getGenreWithPluck(): Genre
    {
        return $this->genre->pluck('name', 'id');
    }

    public function getGenreById(int $id): Genre
    {
        return $this->genre->findOrFail($id);
    }

    public function createGenre(array $data): void
    {
        $data['slug'] = \Str::slug($data['name']);
        $this->genre->create($data);
    }

    public function updateGenre(array $data, Genre $genre): void
    {
        $genre->update($data);
    }

    public function deleteGenre(Genre $genre): void
    {
        $genre->delete();
    }
}
