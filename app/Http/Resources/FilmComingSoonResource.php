<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmComingSoonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this?->id,
            'title' => $this?->title,
            'slug' => $this?->slug,
            'description' => $this?->desc,
            'url_film' => $this?->url_film,
            'url_trailer' => $this?->url_trailer,
            'duration' => $this?->duration,
            'date' => $this?->date,
            'status' => $this?->filmSelling?->status,
//            'gallery' => FilmGalleryResource::collection($this?->gallery),
            'created_at' => $this?->created_at,
            'genre' => $this->whenLoaded('filmGenre', function () {
                return $this->filmGenre->pluck('name');
            }),

        ];
        if ($this?->gallery->count() > 0) {
            $data['image'] = FilmGalleryResource::collection($this?->gallery);
        }
        return $data;
    }
}
