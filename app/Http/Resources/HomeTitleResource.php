<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeTitleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name1' => $this->name1,
            'name2' => $this->name2,
            'name3' => $this->name3,
            'name4' => $this->name4,
            'name5' => $this->name5,
            'name6' => $this->name6,
            'image' => $this->image ? asset($this->image) : null,
            'status' => (bool)$this->status,
        ];
    }
} 