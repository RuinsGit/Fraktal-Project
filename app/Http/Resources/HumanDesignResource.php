<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HumanDesignResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'text' => $this->text,
            'description' => $this->description,
            'status' => $this->status
        ];
    }
} 