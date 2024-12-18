<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesTitle extends Model
{
    use HasFactory;

    protected $table = 'services_title';

    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'text_az',
        'text_en',
        'text_ru'
    ];

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }

    public function getTextAttribute()
    {
        return $this->getAttribute('text_' . app()->getLocale());
    }
}
