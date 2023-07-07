<?php

namespace App\Repository\Film;

use App\DataTransferObjects\FilmDto;
use App\DataTransferObjects\PaginateDto;
use App\DataTransferObjects\SearchFilmDto;
use App\Http\Resources\FilmComingSoonResource;
use App\Http\Resources\FilmDetailResource;
use App\Models\Film;
use Carbon\Carbon;
use Laravel\Scout\Builder;

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
                    ->orderBy("date", "desc")
                    ->get();
    }

    public function getFilmById(int $id)
    {
        return $this->film->with([
            'information',
            'actors',
            'filmSelling',
            'filmGenre',
            'gallery'
        ])->findOrFail($id);
    }

    public function createFilm(array $data)
    {
       return $this->film->create($data);
    }

    public function createFilmDetail(Film $film, array $data)
    {
        $film->information()->createMany($data);
    }

    public function removeFilmDetail(Film $film)
    {
        $film->information()->delete();
    }


    public function addFilmGenre(Film $film, array $data)
    {
        $film->filmGenre()->attach($data);
    }

    public function removeFilmGenre(Film $film)
    {
        $film->filmGenre()->detach();
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

    public function removeImageFilm(Film $film)
    {
        $film->gallery()->delete();
    }


    public function createActorFilm(Film $film, string $name)
    {
        $film->actors()->create(['name' => $name]);
    }

    public function removeActorFilm(Film $film)
    {
        $film->actors()->delete();
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
        
        $films = $this->film
                ->with(['gallery', 'filmGenre', 'filmSelling'])
                ->withCount('filmView')
                ->whereHas('filmSelling', function ($query) {
                    $query->where('status', 'active');
                })
                ->orderByDesc('film_view_count')
                ->paginate($request->per_page?? 10, page: $request->page?? 1);

    $films->getCollection()->transform(function ($film) {
        //tambahkan path gambar
        $film->gallery->transform(function ($gallery) {
            $gallery->images = url('storage/' . $gallery->images);
            return $gallery;
        });

        return $film;
    });

 return $films;
    }

    public function FilmTerbaru($request)
    {
        $films = $this->film
            ->with([
                'gallery',
                'filmGenre:name',
                'filmSelling'
            ])
            ->withCount('filmView') // Tambahkan ini
            ->whereHas('filmSelling', function ($query) {
                $query->where('status', 'active');
            })
            ->orderByDesc('created_at')
            ->paginate($request->per_page?? 10, page: $request->page?? 1);
    
        //tambahkan path gambar
        $films->getCollection()->transform(function ($film) {
            $film->gallery->transform(function ($gallery) {
                $gallery->images = url('storage/' . $gallery->images);
                return $gallery;
            });
            return $film;
        });
    
        return $films;
    }

    
    public function FilmComingsoon($request)
    {
        $film = $this->film
            ->with(['filmSelling', 'gallery', 'filmGenre'])
            ->whereHas('filmSelling', function ($query) {
                $query->where('status', 'comingsoon');
            })->paginate($request->per_page?? 10, page: $request->page?? 1);
//        return $film;
        return [FilmComingSoonResource::collection($film), $film];
    }

    public function filmByGenre(FilmDto $dto): object
    {
        $films = $this->film
        ->with(['gallery', 'filmGenre:name', 'filmGenre','filmSelling'])
        ->whereHas('filmGenre', function ($query) use ($dto) {
            $query->whereSlug($dto->genre);
        })
        ->whereHas('filmSelling', function ($query) {
            $query->where('status', 'active');
        })
        ->paginate($dto->perPage?? 10, page: $dto->page?? 1);

        $films->getCollection()->transform(function ($film) {
        // Tambahkan prefix path ke setiap gambar di galeri
        $film->gallery->transform(function ($gallery) {
            $gallery->images = url('storage/') . '/' . $gallery->images;
            return $gallery;
        });

        return $film;
        });

        return $films;
    }

    public function filmBySlug(string $slug, string $userId = null)
    {
        $film = $this->film
            ->with(['information', 'actors','gallery', 'filmGenre:name', 'filmView', 'filmSelling'])
            ->where('slug', $slug)
            ->firstOrFail();

        if ($userId){
           $film->load(['wishlist' => function ($query) use ($userId) {
               $query->where('user_id', $userId);
           }, 'transaction' => function ($query) use ($userId) {
               $query->where('user_id', $userId)->latest()->first();
           }]);
        }

        return new FilmDetailResource($film);
    }



    public function relatedFilm(FilmDto $dto)
    {
        return $this->film
            ->with(['gallery', 'filmGenre', 'filmSelling'])
            ->whereHas('filmGenre', function ($query) use ($dto) {
                $query->whereName($dto->genre);
            })
            ->whereHas('filmSelling', function ($query) {
                $query->where('status', 'active');
            })
            ->where('id', '!=', $dto->filmId)
            ->paginate($dto->perPage?? 10, page: $dto->page?? 1);
    }
    public function filmBeingWatched(PaginateDto $dto)
    {
        $films = $this->film
            ->with(['gallery', 'transaction:film_id,watch_expired_date'])
            ->withCount('filmView')
            ->whereHas('transaction', function ($query) {
                $query->where('user_id', auth()->user()->id)
                    ->where('payment_status', 'success')
                    ->where('watch_expired_date', '>=', Carbon::now());
            })
            ->get();
    
        // Tambahkan prefix path ke setiap gambar di galeri
        $films->transform(function ($film) {
            $film->gallery->transform(function ($gallery) {
                $gallery->images = url('storage/' . $gallery->images);
                return $gallery;
            });
    
            return $film;
        });
    
        return $films;
    }

    public function filmWatched(PaginateDto $dto)
    {
        $films = $this->film
            ->with(['gallery', 'transaction:film_id,watch_expired_date'])
            ->withCount('filmView')
            ->whereHas('transaction', function ($query) {
                $query->where('user_id', auth()->user()->id)
                    ->where('payment_status', 'success')
                    ->where('watch_expired_date', '<=', Carbon::now());
            })
            ->paginate($dto->perPage?? 10, page: $dto->page?? 1);
    
        // Tambahkan prefix path ke setiap gambar di galeri
        $films->getCollection()->transform(function ($film) {
            $film->gallery->transform(function ($gallery) {
                $gallery->images = url('storage/' . $gallery->images);
                return $gallery;
            });
    
            return $film;
        });
    
        return $films;
    }
    


    public function searchFilm(SearchFilmDto $dto): object
    {
        $search = $this->film->search($dto->search)->query(function ($query) {
            $query->with(['gallery', 'filmGenre:name'])->withCount('filmView')->whereHas('filmSelling', function ($query) {
                $query->where('status', 'active');
            });
        });
    
        $search = $search->tap(function (Builder $search) use ($dto) {
            if (!$dto->new) {
                return;
            }
            $search->orderBy('created_at', 'desc');
        });
    
        $search = $search->tap(function (Builder $search) use ($dto) {
            if (!$dto->sort) {
                return;
            }
            $search->orderBy('title', 'desc');
        });
    
        $films = $search->paginate($dto->perPage?? 10, page: $dto->page?? 1);
    
        $films->getCollection()->transform(function ($film) {
            $film->gallery->transform(function ($gallery) {
                $gallery->images = url('storage/' . $gallery->images);
                return $gallery;
            });
            return $film;
        });
    
        return $films;
    }
    

    public function whislistFilm($film)
    {
        $userWishlist = $film->wishlist()->where('user_id', auth()->id())->first();
        return isset($userWishlist) ? $userWishlist->delete() : $film->wishlist()->create([
            'user_id' => auth()->id()
        ]);

    }

    public function getListWhislistFilm(PaginateDto $dto)
    {
        $films = $this->film
            ->with('gallery', 'filmGenre')
            ->withCount('filmView')
            ->whereHas('wishlist', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->paginate($dto->perPage?? 10, page: $dto->page?? 1);
    
        //tambahkan path gambar
        $films->getCollection()->transform(function ($film) {
            $film->gallery->transform(function ($gallery) {
                $gallery->images = url('storage/' . $gallery->images);
                return $gallery;
            });
            return $film;
        });
    
        return $films;
    }
    

}
