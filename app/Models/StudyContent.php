<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudyContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'text_az',
        'text_en',
        'text_ru',
        'description_az',
        'description_en',
        'description_ru',
        'image',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->slug = Str::slug($model->text_az);
        });
        
        static::updating(function ($model) {
            $model->slug = Str::slug($model->text_az);
        });
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