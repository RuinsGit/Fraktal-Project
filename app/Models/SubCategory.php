<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'category_id',
        'name_az',
        'name_en',
        'name_ru',
        'image',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru',
        'image_title_az',
        'image_title_en',
        'image_title_ru',
        'slug',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }
    
}
