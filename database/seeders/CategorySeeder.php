<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name_az' => 'Kurs 1',
                'name_en' => 'Course 1',
                'name_ru' => 'Курс 1',
                'slug' => Str::slug('Kurs 1'),
                'status' => 1
            ],
            [
                'name_az' => 'Kurs 2',
                'name_en' => 'Course 2',
                'name_ru' => 'Курс 2',
                'slug' => Str::slug('Kurs 2'),
                'status' => 1
            ],
            [
                'name_az' => 'Kurs 3',
                'name_en' => 'Course 3',
                'name_ru' => 'Курс 3',
                'slug' => Str::slug('Kurs 3'),
                'status' => 1
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}