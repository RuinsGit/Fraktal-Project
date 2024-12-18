<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HumanContentCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'data' => [
                'names' => $this->collection->map(function($content) {
                    return [
                        'id' => $content->id,
                        'name' => $content->name
                    ];
                })->values(),
                
                'names_details' => $this->collection->map(function($content) {
                    return [
                        'id' => $content->id,
                        'description' => $content->description,
                        'image' => asset('uploads/human-content/' . $content->image)
                    ];
                })->values()
            ],
            'message' => 'İnsan məzmunu uğurla gətirildi'
        ];
    }
} 