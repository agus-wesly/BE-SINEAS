<?php

namespace App\Http\Resources;

use Google\Service\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => empty($this->title) ? '-' : $this->title,
            'image' => $this->image,
            'expired_date' => $this->expired_date,
            'description' => empty($this->description) ? '-' : $this->description,
            'url_link' => empty($this->url_link) ? '-' : $this->url_link,
            'status' => $this->status,
        ];
    }
}
