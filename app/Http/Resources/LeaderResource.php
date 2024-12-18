<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaderResource extends JsonResource
{
    public function toArray($request)
    {
       
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
            'image' => $this->image ? url('uploads/leaders/' . basename($this->image)) : null
        ];
    }
} 