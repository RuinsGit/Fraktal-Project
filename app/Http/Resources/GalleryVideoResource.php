<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryVideoResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'video' => $this->video ? url('uploads/gallery-videos/' . basename($this->video)) : null,
            'status' => $this->status
        ];
    }
} 