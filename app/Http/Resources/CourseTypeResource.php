<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name_ ,
            'slug' => $this->slug,
            'status' => (bool) $this->status,

        ];
            
        
    }
} 