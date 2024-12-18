<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudyContentCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'data' => [
                'texts' => $this->collection->map(function($content) {
                    return [
                        'id' => $content->id,
                        'text' => $content->text,
                        'slug' => $content->slug
                    ];
                }),
                
                'text_details' => $this->collection->map(function($content) {
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
} 