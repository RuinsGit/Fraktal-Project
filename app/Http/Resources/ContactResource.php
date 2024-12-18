<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'workhours' => $this->workhours,
            'social_media' => [
                 [
                    'url' => $this->facebook,
                    'logo' => $this->logo ? url('uploads/contact/' . basename($this->logo)) : null,
                    'id' => rand(1, 1000000)


                ],
                [
                    'url' => $this->instagram,
                    'logo' => $this->logo_2 ? url('uploads/contact/' . basename($this->logo_2)) : null,
                    'id' => rand(1, 1000000)
                ],
                 [
                    'url' => $this->youtube,
                    'logo' => $this->favicon ? url('uploads/contact/' . basename($this->favicon)) : null,
                    'id' => rand(1, 1000000)
                ]
            ],
            
        ];
    }
} 