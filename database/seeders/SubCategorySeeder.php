<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    public function run()
    {
        $subCategories = [
            // Kurs 1'in alt kategorileri
            [
                'category_id' => 1,
                'name_az' => 'Kurs 1 Alt 1',
                'name_en' => 'Course 1 Sub 1',
                'name_ru' => 'Курс 1 Под 1',
                'slug' => Str::slug('Kurs 1 Alt 1'),
                'status' => 1
            ],
            [
                'category_id' => 1,
                'name_az' => 'Kurs 1 Alt 2',
                'name_en' => 'Course 1 Sub 2',
                'name_ru' => 'Курс 1 Под 2',
                'slug' => Str::slug('Kurs 1 Alt 2'),
                'status' => 1
            ],
            [
                'category_id' => 1,
                'name_az' => 'Kurs 1 Alt 3',
                'name_en' => 'Course 1 Sub 3',
                'name_ru' => 'Курс 1 Под 3',
                'slug' => Str::slug('Kurs 1 Alt 3'),
                'status' => 1
            ],
            // Kurs 2'nin alt kategorileri
            [
                'category_id' => 2,
                'name_az' => 'Kurs 2 Alt 1',
                'name_en' => 'Course 2 Sub 1',
                'name_ru' => 'Курс 2 Под 1',
                'slug' => Str::slug('Kurs 2 Alt 1'),
                'status' => 1
            ],
            [
                'category_id' => 2,
                'name_az' => 'Kurs 2 Alt 2',
                'name_en' => 'Course 2 Sub 2',
                'name_ru' => 'Курс 2 Под 2',
                'slug' => Str::slug('Kurs 2 Alt 2'),
                'status' => 1
            ],
            [
                'category_id' => 2,
                'name_az' => 'Kurs 2 Alt 3',
                'name_en' => 'Course 2 Sub 3',
                'name_ru' => 'Курс 2 Под 3',
                'slug' => Str::slug('Kurs 2 Alt 3'),
                'status' => 1
            ],
            // Kurs 3'ün alt kategorileri
            [
                'category_id' => 3,
                'name_az' => 'Kurs 3 Alt 1',
                'name_en' => 'Course 3 Sub 1',
                'name_ru' => 'Курс 3 Под 1',
                'slug' => Str::slug('Kurs 3 Alt 1'),
                'status' => 1
            ],
            [
                'category_id' => 3,
                'name_az' => 'Kurs 3 Alt 2',
                'name_en' => 'Course 3 Sub 2',
                'name_ru' => 'Курс 3 Под 2',
                'slug' => Str::slug('Kurs 3 Alt 2'),
                'status' => 1
            ],
            [
                'category_id' => 3,
                'name_az' => 'Kurs 3 Alt 3',
                'name_en' => 'Course 3 Sub 3',
                'name_ru' => 'Курс 3 Под 3',
                'slug' => Str::slug('Kurs 3 Alt 3'),
                'status' => 1
            ]
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create($subCategory);
        }
    }
}