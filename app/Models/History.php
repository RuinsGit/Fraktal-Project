<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'text_az',
        'text_en',
        'text_ru',
        'status',
    ];

    public function getTextAttribute()
    {
        return $this->getAttribute('text_' . app()->getLocale());
    }
}
