<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_az' => 'required',
            'title_en' => 'required',
            'title_ru' => 'required',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'image' => $this->isMethod('POST') ? 'required|image|mimes:jpeg,png,jpg,svg|max:2048' 
                                              : 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title_az.required' => 'Azərbaycan dilində başlıq daxil edilməlidir',
            'title_en.required' => 'İngilis dilində başlıq daxil edilməlidir',
            'title_ru.required' => 'Rus dilində başlıq daxil edilməlidir',
            'description_az.required' => 'Azərbaycan dilində mətn daxil edilməlidir',
            'description_en.required' => 'İngilis dilində mətn daxil edilməlidir',
            'description_ru.required' => 'Rus dilində mətn daxil edilməlidir',
            'image.required' => 'Şəkil mütləq yüklənməlidir',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır',
            'image.max' => 'Şəkil maksimum 2MB ola bilər'
        ];
    }
}
