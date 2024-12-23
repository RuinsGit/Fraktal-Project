<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVideoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'video_path' => $this->video_path ? url($this->video_path) : null,
            'duration' => $this->duration,
            'formatted_duration' => $this->formatted_duration,
            'order' => $this->order,
            'download_count' => $this->download_count,
            'view_count' => $this->view_count,
            'rating' => $this->rating,
            'description' => $this->description
        ];
    }
} 