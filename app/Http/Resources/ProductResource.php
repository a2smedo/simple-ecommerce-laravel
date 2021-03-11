<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name(),
            'desc' => $this->desc(),
            'img' => asset("uploads/$this->img"),
            'price' => $this->price,
            'quantity' => $this->quantity,
            'reviews' => $this->reviews,
            'rating' => $this->rating,
            'discount' => $this->discount,
            'active' => $this->active,
            'created_at' => $this->created_at->format('Y-M-d h:i:s A'),
        ];
    }
}
