<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DigitalPsychologyTitleResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/digital-psychology-title/' . basename($this->image)) : null,
            'name' => $this->name,
            'text' => $this->text,
            'status' => $this->status
        ];
    }
} 