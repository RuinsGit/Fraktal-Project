<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudyContentResource extends JsonResource
{
    public static function customCollection($resource)
    {
        return [
            'status' => 'success',
            'data' => [
                'texts' => $resource->map(function($content) {
                    return [
                        'id' => $content->id,
                        'text' => $content->text,
                        'slug' => $content->slug
                    ];
                }),
                
                'text_details' => $resource->map(function($content) {
                    return [
                        'id' => $content->id,
                        'description' => $content->description,
                        'image' => asset('uploads/study-content/' . $content->image)
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
            'text' => $this->text,
            'description' => $this->description,
            'image' => asset('uploads/study-content/' . $this->image)
        ];
    }
} 