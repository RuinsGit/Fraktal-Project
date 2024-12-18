<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'email',
        'phone',
        'address_az',
        'address_en',
        'address_ru',
        'work_hours_az',
        'work_hours_en',
        'work_hours_ru',
        'facebook',
        'instagram',
        'youtube',
        'logo',
        'logo_2',
        'favicon'
    ];

    public function getAddressAttribute()
    {
        return $this->getAttribute('address_' . app()->getLocale());
    }

    public function getWorkhoursAttribute()
    {
        return $this->getAttribute('work_hours_' . app()->getLocale());
    }
    
}
