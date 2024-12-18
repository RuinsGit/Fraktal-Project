<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'name1_az', 'name1_en', 'name1_ru', 'image'
    ];
} 