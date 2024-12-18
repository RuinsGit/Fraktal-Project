<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HumanContentResource extends JsonResource
{
    public static function customCollection($resource)
    {
        return [
            'status' => 'success',
            'data' => [
                'names' => $resource->map(function($content) {
                    return [
                        'id' => $content->id,
                        'name' => $content->name
                    ];
                }),
                
                'names_details' => $resource->map(function($content) {
                    return [
                        'id' => $content->id,
                        'description' => $content->description,
                        'image' => asset('uploads/human-content/' . $content->image)
                    ];
                })
            ],
            'message' => 'Məlumatlar uğurla gətirildi'
        ];
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => asset('uploads/human-content/' . $this->image)
        ];
    }
} 