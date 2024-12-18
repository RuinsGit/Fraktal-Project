<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LeaderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'position_az' => 'required|string|max:255',
            'position_en' => 'required|string|max:255',
            'position_ru' => 'required|string|max:255',
            'image' => $this->isMethod('POST') ? 'required|image|mimes:jpeg,png,jpg,svg|max:2048' 
                                              : 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name_az.required' => 'Ad Soyad (AZ) daxil edilməlidir',
            'name_en.required' => 'Ad Soyad (EN) daxil edilməlidir',
            'name_ru.required' => 'Ad Soyad (RU) daxil edilməlidir',
            'position_az.required' => 'Vəzifə (AZ) daxil edilməlidir',
            'position_en.required' => 'Vəzifə (EN) daxil edilməlidir',
            'position_ru.required' => 'Vəzifə (RU) daxil edilməlidir',
            'image.required' => 'Şəkil mütləq yüklənməlidir',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır',
            'image.max' => 'Şəkil maksimum 2MB ola bilər'
        ];
    }
}