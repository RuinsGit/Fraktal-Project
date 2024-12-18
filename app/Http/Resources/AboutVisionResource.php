<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutVisionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'image' => $this->image ? url('uploads/about/vision/' . basename($this->image)) : "",
            'visions' => [
                [
                    'logo' => $this->icon_1 ? url('uploads/about/vision/' . basename($this->icon_1)) : "",
                    'title' => $this->name1,
                    'description' => $this->text1,
                    'id' => rand(1, 1000000) 
                ],
                [
                    'logo' => $this->icon_2 ? url('uploads/about/vision/' . basename($this->icon_2)) : "",
                    'title' => $this->name2, 
                    'description' => $this->text2,
                    'id' => rand(1, 1000000) 
                ]
            ]
        ];
    }
} 