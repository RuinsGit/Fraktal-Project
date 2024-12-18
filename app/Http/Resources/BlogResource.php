<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? url('uploads/blogs/' . basename($this->image)) : null,
            'view_count' => $this->view_count,
            'status' => $this->status,
            'slug' => $this->slug,
            'published_at' => $this->published_at ? Carbon::parse($this->published_at)->format('Y-m-d H:i:s') : null,
            'blog_type' => [
                'id' => $this->blogType?->id,
                'name' => $this->blogType?->name,
                
            ]
        ];
    }
}
