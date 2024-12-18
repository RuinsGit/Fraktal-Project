<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutCompanyResource extends JsonResource
{
    public function toArray($request)
    {
       
        
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/about/' . basename($this->image)) : null,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status
        ];
    }
} 