<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = app()->getLocale();
        
        return [
            'id' => $this->id,
            'name' => $this->{"name_" . $locale},
            'slug' => $this->slug,
            'sub_categories' => SubCategoryResource::collection($this->whenLoaded('sub_categories')),
        ];
    }
} 