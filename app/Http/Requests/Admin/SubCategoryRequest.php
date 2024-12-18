<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'image_alt_az' => 'required|string|max:255',
            'image_alt_en' => 'required|string|max:255',
            'image_alt_ru' => 'required|string|max:255',
            'image_title_az' => 'required|string|max:255',
            'image_title_en' => 'required|string|max:255',
            'image_title_ru' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Zəhmət olmasa, kateqoriya seçin',
            'category_id.exists' => 'Seçilən kateqoriya mövcud deyil',
            'name_az.required' => 'Zəhmət olmasa, adı Azərbaycan dilində daxil edin',
            'name_en.required' => 'Zəhmət olmasa, adı İngilis dilində daxil edin',
            'name_ru.required' => 'Zəhmət olmasa, adı Rus dilində daxil edin',
            'image.required' => 'Zəhmət olmasa, şəkil seçin',
            'image.image' => 'Seçilən fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg və ya svg olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB olmalıdır',
            'image_alt_az.required' => 'Zəhmət olmasa, şəkil alt mətnini Azərbaycan dilində daxil edin',
            'image_alt_en.required' => 'Zəhmət olmasa, şəkil alt mətnini İngilis dilində daxil edin',
            'image_alt_ru.required' => 'Zəhmət olmasa, şəkil alt mətnini Rus dilində daxil edin',
            'image_title_az.required' => 'Zəhmət olmasa, şəkil başlığını Azərbaycan dilində daxil edin',
            'image_title_en.required' => 'Zəhmət olmasa, şəkil başlığını İngilis dilində daxil edin',
            'image_title_ru.required' => 'Zəhmət olmasa, şəkil başlığını Rus dilində daxil edin',
        ];
    }
}
