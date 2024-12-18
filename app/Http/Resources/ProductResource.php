<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            
            'price' => $this->price,
            'discount_percentage' => $this->discount_percentage,
            'discounted_price' => $this->discounted_price,
            'thumbnail' => $this->thumbnail ? url('uploads/products/' . basename($this->thumbnail)) : null,
            'preview_video' => $this->preview_video ? url('uploads/products/videos/previews/' . basename($this->preview_video)) : null,
            'slug' => $this->slug,
            'category' => new CategoryResource($this->whenLoaded('category')),
            
            'course_type' => new CourseTypeResource($this->whenLoaded('courseType')),
            'videos' => ProductVideoResource::collection($this->whenLoaded('videos')),

        ];
    }
} 