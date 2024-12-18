<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HeaderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/headers/' . basename($this->image)) : null,
            'home' => $this->home,
            'about' => $this->about,
            'vision' => $this->vision,
            'history' => $this->history,
            'leadership' => $this->leadership,
            'services_az' => $this->services_az,
            'ourservices' => $this->ourservices,
            'courses' => $this->courses,
            'studyprogram' => $this->studyprogram,
            'digitalpsychology' => $this->digitalpsychology,
            'humandesign' => $this->humandesign,
            'media' => $this->media,
            'gallery' => $this->gallery,
            'blogs' => $this->blogs,
            'contact' => $this->contact,

        ];
    }
} 