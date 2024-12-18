<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'status' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name_az.required' => 'Kateqoriya adı (AZ) tələb olunur',
            'name_en.required' => 'Kateqoriya adı (EN) tələb olunur',
            'name_ru.required' => 'Kateqoriya adı (RU) tələb olunur',
            'name_az.max' => 'Kateqoriya adı (AZ) maksimum 255 simvol ola bilər',
            'name_en.max' => 'Kateqoriya adı (EN) maksimum 255 simvol ola bilər',
            'name_ru.max' => 'Kateqoriya adı (RU) maksimum 255 simvol ola bilər',
        ];
    }
}