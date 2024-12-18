<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudyingProgramResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/' . basename($this->image)) : null,
            'name' => $this->name,
            'text' => $this->text,
            'description' => $this->description,
            'status' => $this->status
        ];
    }
} 