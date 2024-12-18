<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title_az.required' => 'Qalereya başlığı (AZ) tələb olunur',
            'title_en.required' => 'Qalereya başlığı (EN) tələb olunur',
            'title_ru.required' => 'Qalereya başlığı (RU) tələb olunur',
            'title_az.max' => 'Qalereya başlığı (AZ) maksimum 255 simvol ola bilər',
            'title_en.max' => 'Qalereya başlığı (EN) maksimum 255 simvol ola bilər',
            'title_ru.max' => 'Qalereya başlığı (RU) maksimum 255 simvol ola bilər',
            'image.required' => 'Şəkil mütləq yüklənməlidir',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır',
            'image.max' => 'Şəkil maksimum 2MB ola bilər'
        ];
    }
}