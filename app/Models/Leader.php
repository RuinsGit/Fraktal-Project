<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'position_az',
        'position_en',
        'position_ru',
        'image'
    ];

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }

    public function getPositionAttribute()
    {
        return $this->getAttribute('position_' . app()->getLocale());
    }
}