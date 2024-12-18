<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ad tələb olunur',
            'email.required' => 'E-poçt ünvanı tələb olunur',
            'email.email' => 'Düzgün e-poçt ünvanı daxil edin',
            'email.unique' => 'Bu e-poçt ünvanı artıq istifadə olunur',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg və ya webp olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
            'current_password.required_with' => 'Cari şifrə tələb olunur',
            'new_password.min' => 'Yeni şifrə minimum 6 simvol olmalıdır',
            'new_password.confirmed' => 'Şifrə təsdiqi uyğun gəlmir',
        ];
    }
}
