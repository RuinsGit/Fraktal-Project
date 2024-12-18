<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name1' => $this->name1,
            'name2' => $this->name2,
            'image' => $this->image ? url('uploads/companies/' . basename($this->image)) : null,
            'status' => $this->status
        ];
    }
} 