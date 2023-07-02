<?php

namespace App\Services\Genre;

use App\Repository\genre\IGenreRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GenreService implements \App\services\genre\IGenreService
{
    private IGenreRepository $genreRepo;

    public function __construct(IGenreRepository $genreRepo)
    {
        $this->genreRepo = $genreRepo;
    }
    public function getAllGenres(): object
    {
        try {
            return $this->genreRepo->getAllGenres();
        } catch (\Exception $e) {
            report($e);
           throw ValidationException::withMessages(['error' => 'Server error']);
        }
    }

    public function getGenreWithPluck(): object
    {
        return $this->genreRepo->getGenreWithPluck();
    }

    public function getGenreById(int $id): object
    {
        return $this->genreRepo->getGenreById($id);
    }

    public function addGenre(Request $request): void
    {
        try {
            $data = $request->all();
            $data['image'] =  $request->file('image')->store(
                'assert/genre',
                'public'
            );
            $this->genreRepo->createGenre($data);
        } catch (\Exception $e) {
            report($e);
            ValidationException::withMessages(['error' => 'Server error']);
        }
    }

    public function editGenre(Request $request, int $id): void
    {
//        try {
            $data = $request->all();
            $genre = $this->genreRepo->getGenreById($id);
            if ($request->hasFile('image')) {

                if (file_exists(public_path('storage/'.$genre->image))) {
                    unlink(public_path('storage/'.$genre->image));
                }

                $data['image'] =  $request->file('image')->store(
                    'assert/genre',
                    'public'
                );
            }
            $this->genreRepo->updateGenre($data, $genre);
//        } catch (\Exception $e) {
//            report($e);
//            ValidationException::withMessages(['error' => 'Server error']);
//        }
    }

    public function deleteGenre(int $id): void
    {
        try {
            $genre = $this->genreRepo->getGenreById($id);
            $this->genreRepo->deleteGenre($genre);
        } catch (\Exception $e) {
            report($e);
            ValidationException::withMessages(['error' => 'Server error']);
        }
    }
}
