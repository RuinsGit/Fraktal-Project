<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
            'image' => $this->image ? url('uploads/comments/' . basename($this->image)) : null,
            'title' => $this->title,
            'comment' => $this->comment,
            'status' => $this->status
        ];
    }
} 