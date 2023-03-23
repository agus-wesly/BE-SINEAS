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
        return [
            'id' => $this?->id,
            'title' => $this?->title,
            'description' => $this?->desc,
            'url_film' => $this?->url_film,
            'url_trailer' => $this?->url_trailer,
            'duration' => $this?->duration,
            'date' => $this?->date,
            'status' => $this?->filmSelling?->status,
            'gallery' => $this?->gallery,
            'created_at' => $this?->created_at,
        ];
    }
}
