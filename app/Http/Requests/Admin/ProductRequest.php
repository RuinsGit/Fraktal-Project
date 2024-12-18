<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'course_type_id' => 'required|exists:course_types,id',
            'price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'preview_video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'videos.*' => 'nullable|mimes:mp4,mov,ogg,qt|max:102400',
            'video_titles.*' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'order' => 'nullable|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name_az.required' => 'Ad (AZ) daxil edilməlidir',
            'name_en.required' => 'Ad (EN) daxil edilməlidir',
            'name_ru.required' => 'Ad (RU) daxil edilməlidir',
            'title_az.required' => 'Başlıq (AZ) daxil edilməlidir',
            'title_en.required' => 'Başlıq (EN) daxil edilməlidir',
            'title_ru.required' => 'Başlıq (RU) daxil edilməlidir',
            'description_az.required' => 'Təsvir (AZ) daxil edilməlidir',
            'description_en.required' => 'Təsvir (EN) daxil edilməlidir',
            'description_ru.required' => 'Təsvir (RU) daxil edilməlidir',
            'category_id.required' => 'Kateqoriya seçilməlidir',
            'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil',
            'course_type_id.required' => 'Kurs növü seçilməlidir',
            'course_type_id.exists' => 'Seçilən kurs növü mövcud deyil',
            'price.required' => 'Qiymət daxil edilməlidir',
            'price.numeric' => 'Qiymət rəqəm olmalıdır',
            'price.min' => 'Qiymət mənfi ola bilməz',
            'thumbnail.required' => 'Əsas şəkil yüklənməlidir',
            'thumbnail.image' => 'Fayl şəkil formatında olmalıdır',
            'thumbnail.mimes' => 'Şəkil formatı: jpeg, png, jpg, gif olmalıdır',
            'thumbnail.max' => 'Şəkil həcmi 2MB-dan çox ola bilməz',
            'preview_video.mimes' => 'Video formatı: mp4, mov, ogg, qt olmalıdır',
            'preview_video.max' => 'Video həcmi 20MB-dan çox ola bilməz',
            'videos.*.required' => 'Video yüklənməlidir',
            'videos.*.mimes' => 'Video formatı: mp4, mov, ogg, qt olmalıdır',
            'videos.*.max' => 'Video həcmi 100MB-dan çox ola bilməz',
            'video_titles.*.required' => 'Video başlığı daxil edilməlidir',
        ];
    }
}
