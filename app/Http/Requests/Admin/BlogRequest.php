<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'blog_type_id' => 'required|exists:blog_types,id',
            'image' => $this->isMethod('PUT') ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' : 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'nullable|in:0,1,2',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title_az.required' => 'Azərbaycan dilində başlıq daxil edin',
            'title_en.required' => 'İngilis dilində başlıq daxil edin',
            'title_ru.required' => 'Rus dilində başlıq daxil edin',
            'description_az.required' => 'Azərbaycan dilində mətn daxil edin',
            'description_en.required' => 'İngilis dilində mətn daxil edin',
            'description_ru.required' => 'Rus dilində mətn daxil edin',
            'image.required' => 'Şəkil seçin',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, gif olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
            'status.required' => 'Status seçin',
            'status.in' => 'Status yanlışdır',
            'blog_type_id.required' => 'Blog növü seçilməlidir',
            'blog_type_id.exists' => 'Seçilən blog növü mövcud deyil',
        ];
    }
}