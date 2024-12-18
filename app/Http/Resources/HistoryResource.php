<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\History;

class HistoryResource extends JsonResource
{
    public static function customCollection($resource)
    {
        return [
            'years' => $resource->map(function($history) {
                return [
                    'id' => $history->id,
                    'year' => $history->number
                ];
            }),
            
            'year_content' => $resource->map(function($history) {
                return [
                    'id' => $history->id,
                    'description' => $history->text
                ];
            })
        ];
    }

    public function toArray($request)
    {
        // Tekil kayıt için kullanılacak
        return [
            'id' => $this->id,
            'year' => $this->number,
            'description' => $this->text
        ];
    }
} 