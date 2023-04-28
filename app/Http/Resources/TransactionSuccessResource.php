<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionSuccessResource extends JsonResource
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
            'film_name' => $this->whenLoaded('film', fn() => $this?->film?->title),
            'transaction_date' => $this?->transaction_date,
            'total' => $this?->subtotal,
            'payment_status' => $this?->payment_status,
        ];
    }
}
