<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_1_az', 'name_1_en', 'name_1_ru',
        'name_2_az', 'name_2_en', 'name_2_ru',
        'name_3_az', 'name_3_en', 'name_3_ru',
        'name_4_az', 'name_4_en', 'name_4_ru',
        'name_5_az', 'name_5_en', 'name_5_ru',
        'name_6_az', 'name_6_en', 'name_6_ru',
        'image',
        'status'
    ];

    public function getName1Attribute()
    {
        return $this->getAttribute('name_1_' . app()->getLocale());
    }
    public function getName2Attribute()
    {
        return $this->getAttribute('name_2_' . app()->getLocale());
    }
    public function getName3Attribute()
    {
        return $this->getAttribute('name_3_' . app()->getLocale());
    }
    public function getName4Attribute()
    {
        return $this->getAttribute('name_4_' . app()->getLocale());
    }
    public function getName5Attribute()
    {
        return $this->getAttribute('name_5_' . app()->getLocale());
    }
    public function getName6Attribute()
    {
        return $this->getAttribute('name_6_' . app()->getLocale());
    }

}
