<?php

namespace App\Repository\Film;

use App\Models\Film;

class FilmRepository implements IFilmRepository
{
    private Film $film;

    public function __construct(Film $film)
    {
        $this->film = $film;
    }

    public function getAllFilm()
    {
        return $this->film
                    ->with('gallery')
                    ->get();
    }

    public function getFilmById(int $id)
    {
        return $this->film->findOrFail($id);
    }

    public function createFilm(array $data)
    {
       return $this->film->create($data);
    }

    public function createActorFilm(Film $film, string $name)
    {
        $film->actors()->create(['name' => $name]);
    }

    public function createImageFilm(array $data)
    {
        $this->film->gallery()->createMany($data);
    }

    public function updateFilm(array $data, $film)
    {
        $film->update($data);
    }

    public function deleteFilm(int $id)
    {
        $this->film->findOrFail($id)->delete();
    }

    public function deleteImageFilm(int $id)
    {
        $this->film->gallery()->findOrFail($id)?->delete();
    }
}
