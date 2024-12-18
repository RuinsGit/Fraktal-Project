<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name_az',
        'text_az',
        'description_az',
        'name_en',
        'text_en',
        'description_en',
        'name_ru',
        'text_ru',
        'description_ru',
        'status'
    ];

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }

    public function getTextAttribute()
    {
        return $this->getAttribute('text_' . app()->getLocale());
    }

    public function getDescriptionAttribute()
    {
        return $this->getAttribute('description_' . app()->getLocale());
    }
}
