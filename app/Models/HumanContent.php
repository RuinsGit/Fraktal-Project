<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'description_az',
        'description_en',
        'description_ru',
        'image',
        'status'
    ];

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }

    public function getDescriptionAttribute()
    {
        return $this->getAttribute('description_' . app()->getLocale());
    }
}
