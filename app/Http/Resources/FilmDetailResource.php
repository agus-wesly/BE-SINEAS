<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $data = [
            'id' => $this?->id,
            'title' => $this?->title,
            'slug' => $this?->slug,
            'description' => $this?->desc,
            'url_trailer' => $this?->url_trailer,
            'duration' => $this?->duration,
            'date' => $this?->date,
            'status' => $this?->filmSelling?->status,
            'price' => $this?->filmSelling?->sellingPrice?->price,
            'film_selling_id' => $this?->filmSelling?->id,
            'gallery' => $this->whenLoaded('gallery' , function () {
                return FilmGalleryResource::collection($this->gallery);
            }),
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
            'is_free' => $this?->filmSelling?->is_free,
            'transaction' => $this?->whenLoaded('transaction', function (){
                return $this->transaction->watch_expired_date >= now();
            }),
            'watch_expired_date' => $this?->whenLoaded('transaction', function (){
                return $this->transaction->watch_expired_date ?? null;
            }),
        ];

        if ($this?->filmSelling?->is_free) {
            $data['transaction'] = true;
        }
        if ($data['transaction'] === true) {
            $data['url_film'] = $this?->url_film;
        }

        return $data;
    }
}
