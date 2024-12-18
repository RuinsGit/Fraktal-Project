<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }

} 