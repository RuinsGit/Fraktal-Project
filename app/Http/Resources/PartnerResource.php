<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/partners/' . basename($this->image)) : null,
            'link' => $this->link,
            'status' => $this->status
        ];
    }
} 