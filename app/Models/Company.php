<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name_1_az',
        'name_1_en',
        'name_1_ru',
        'name_2_az',
        'name_2_en',
        'name_2_ru',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getName1Attribute()
    {
        return $this->getAttribute('name_1_' . app()->getLocale());
    }

    public function getName2Attribute()
    {
        return $this->getAttribute('name_2_' . app()->getLocale());
    }
}
