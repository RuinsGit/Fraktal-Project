<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'position',
        'image',
        'title_az',
        'title_en',
        'title_ru',
        'comment_az',
        'comment_en',
        'comment_ru',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getTitleAttribute()
    {
        return $this->getAttribute('title_' . app()->getLocale());
    }

    public function getCommentAttribute()
    {
        return $this->getAttribute('comment_' . app()->getLocale());
    }
}
