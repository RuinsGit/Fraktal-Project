<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FooterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'footer_info' => [
                // Diğer footer bilgileri burada yer alabilir
            ],
            'services' => ServiceResource::collection($this), // Son 5 servisi burada döndür
        ];
    }
}