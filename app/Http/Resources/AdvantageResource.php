<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvantageResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/advantages/' . basename($this->image)) : null,
            'name' => $this->name,
            'text' => $this->text,
            'status' => $this->status
        ];
    }
} 