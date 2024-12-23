<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRoute extends Model
{
    protected $fillable = [
        'text_az',
        'text_en',
        'text_ru',
        'link',
        'status',
        'order'
    ];

    public function getTextAttribute()
    {
        return $this->getAttribute('text_' . app()->getLocale());
    }

    protected $casts = [
        'status' => 'boolean'
    ];
} 