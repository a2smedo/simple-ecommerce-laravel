<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
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
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'active' => $this->active,
            'created_at' => $this->created_at->format('Y-M-d h:i:s A'),
        ];
    }
}
