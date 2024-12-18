<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? url('uploads/sub_categories/' . basename($this->image)) : null,
            'slug' => $this->slug,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
} 