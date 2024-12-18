<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title_az.required' => 'Başlıq (Az) tələb olunur',
            'title_en.required' => 'Başlıq (En) tələb olunur',
            'title_ru.required' => 'Başlıq (Ru) tələb olunur',
            'description_az.required' => 'Mətn (Az) tələb olunur',
            'description_en.required' => 'Mətn (En) tələb olunur',
            'description_ru.required' => 'Mətn (Ru) tələb olunur',
            'image.image' => 'Fayl şəkil olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır',
            'image.max' => 'Şəkil ölçüsü maksimum 2MB olmalıdır'
        ];
    }
}
