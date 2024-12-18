<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;

    protected $fillable = [
        'title_az', 'title_en', 'title_ru',
        'description_az', 'description_en', 'description_ru',
        'image', 'view_count', 'status', 'slug', 'published_at',
        'blog_type_id'
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function blogType()
    {
        return $this->belongsTo(BlogType::class);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_INACTIVE => 'Deaktiv',
            self::STATUS_ACTIVE => 'Aktiv',
            self::STATUS_DRAFT => 'Qaralama'
        ];
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_INACTIVE => 'danger',
            self::STATUS_ACTIVE => 'success',
            self::STATUS_DRAFT => 'warning'
        ];

        return '<span class="badge bg-' . $badges[$this->status] . '">' . self::getStatusList()[$this->status] . '</span>';
    }

    public function getTitleAttribute()
    {
        return $this->getAttribute('title_' . app()->getLocale());
    }

    public function getDescriptionAttribute()
    {
        return $this->getAttribute('description_' . app()->getLocale());
    }
}
