<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'title_az',
        'title_en',
        'title_ru',
        'description_az',
        'description_en',
        'description_ru',
        'category_id',
        'course_type_id',
        'price',
        'discount_percentage',
        'discounted_price',
        'thumbnail',
        'preview_video',
        'status',
        'order',
        'slug'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
    }

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }

    public function getTitleAttribute()
    {
        return $this->getAttribute('title_' . app()->getLocale());
    }

    public function getDescriptionAttribute()
    {
        return $this->getAttribute('description_' . app()->getLocale());
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }
    
}
