<?php

namespace App\Repository\Film;

use App\Http\Resources\FilmComingSoonResource;
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
        return $this->film->with(['information','actors'])->findOrFail($id);
    }

    public function createFilm(array $data)
    {
       return $this->film->create($data);
    }

    public function createFilmDetail(Film $film, array $data)
    {
        $film->information()->createMany($data);
    }

    public function addFilmGenre(Film $film, array $data)
    {
        $film->filmGenre()->attach($data);
    }

    public function addImageFilm(Film $film, array $data)
    {
        array_map(static function ($image) use ($film, $data, &$index) {
            $index = $index ?? 0;
            $film->gallery()->create([
                'images' => $image,
                'type' => $data['type'][$index]
            ]);
            $index++;
        }, $data['name']);
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

    public function FilmPopuler($request)
    {
        return $this->film
                ->with('gallery')
                ->withCount('filmView')
                ->orderByDesc('film_view_count')
                ->paginate($request->per_page?? 10, page: $request->page?? 1);
    }

    public function FilmTerbaru($request)
    {
        return $this->film
            ->with('gallery')
            ->orderByDesc('created_at')
            ->paginate($request->per_page?? 10, page: $request->page?? 1);
    }
    public function FilmComingsoon($request)
    {
        $film = $this->film
            ->with(['filmSelling', 'gallery'])
            ->whereHas('filmSelling', function ($query) {
                $query->where('status', 'comingsoon');
            })->paginate($request->per_page?? 10, page: $request->page?? 1);
        return [FilmComingSoonResource::collection($film), $film];
    }

    public function filmBySlug(string $slug)
    {
        return FilmComingSoonResource::collection($this->film
            ->with(['information', 'actors','gallery', 'filmGenre:name'])
            ->where('slug', $slug)
            ->firstOrFail());
    }


}
