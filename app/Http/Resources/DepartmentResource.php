<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'active' => $this->active,
            'created_at' => $this->created_at->format('Y-M-d h:i:s A'),
        ];
    }
}
