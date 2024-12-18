<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address_az' => 'required|string|max:255',
            'address_en' => 'required|string|max:255',
            'address_ru' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255'
        ];
    }

    public function messages()
    {
        return [
            'address_az.required' => 'Ünvan (AZ) tələb olunur',
            'address_en.required' => 'Ünvan (EN) tələb olunur',
            'address_ru.required' => 'Ünvan (RU) tələb olunur',
            'phone.required' => 'Telefon nömrəsi tələb olunur',
            'email.required' => 'E-poçt ünvanı tələb olunur',
            'email.email' => 'Düzgün e-poçt ünvanı daxil edin',
            'facebook.url' => 'Facebook linki düzgün formatda deyil',
            'instagram.url' => 'Instagram linki düzgün formatda deyil',
            'twitter.url' => 'Twitter linki düzgün formatda deyil',
            'linkedin.url' => 'LinkedIn linki düzgün formatda deyil',
        ];
    }
}
