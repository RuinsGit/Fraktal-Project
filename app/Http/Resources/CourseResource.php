<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/courses/' . basename($this->image)) : null,
            'name' => $this->name,
            'text' => $this->text,
            'status' => $this->status
        ];
    }
} 