<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'comment' => 'required|string',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Başlıq daxil edin',
            'comment.required' => 'Rəy daxil edin',
            'name.required' => 'Ad daxil edin',
            'position.required' => 'Vəzifə daxil edin',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, gif olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
            'status.required' => 'Status seçin',
            'status.boolean' => 'Status yanlışdır',
        ];
    }
}
