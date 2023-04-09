<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            'title' => $this?->title,
            'slug' => $this?->slug,
            'description' => $this?->desc,
            'url_film' => $this?->url_film,
            'url_trailer' => $this?->url_trailer,
            'duration' => $this?->duration,
            'date' => $this?->date,
            'status' => $this?->filmSelling?->status,
            'gallery' => $this->whenLoaded('gallery'),
            'view' => $this->whenLoaded('filmView', function () {
                return $this->filmView->count();
            }),
            'wishlist' => $this->whenLoaded('wishlist', function () {
                return $this->wishlist->count();
            }),
            'information' => $this?->whenLoaded('information'),
            'actors' => $this?->whenLoaded('actors'),
            'filmGenre' =>$this?->whenLoaded('filmGenre'),
            'created_at' => $this?->created_at,
        ];
    }
}
