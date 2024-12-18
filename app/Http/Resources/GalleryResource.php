<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->main_image ? url('uploads/gallery/' . basename($this->main_image)) : "",
            'gallery' => $this->sub_images ? array_map(function($image) {
                return [
                    'id' => rand(1, 1000000),
                    'image_gallery' => url('uploads/gallery/' . basename($image))
                ];
            }, json_decode($this->sub_images, true)) : []
        ];
    }
} 