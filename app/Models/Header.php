<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'home_az', 'about_az', 'vision_az', 'history_az', 'leadership_az', 'services_az', 'our_services_az',
        'courses_az', 'study_program_az', 'digital_psychology_az', 'human_design_az', 'media_az', 'gallery_az',
        'blogs_az', 'contact_az',
        
        'home_en', 'about_en', 'vision_en', 'history_en', 'leadership_en', 'services_en', 'our_services_en',
        'courses_en', 'study_program_en', 'digital_psychology_en', 'human_design_en', 'media_en', 'gallery_en',
        'blogs_en', 'contact_en',
        
        'home_ru', 'about_ru', 'vision_ru', 'history_ru', 'leadership_ru', 'services_ru', 'our_services_ru',
        'courses_ru', 'study_program_ru', 'digital_psychology_ru', 'human_design_ru', 'media_ru', 'gallery_ru',
        'blogs_ru', 'contact_ru',
    ];
    public function getHomeAttribute()
    {
        return $this->getAttribute('home_' . app()->getLocale());
    }
    public function getAboutAttribute()
    {
        return $this->getAttribute('about_' . app()->getLocale());
    }
    public function getVisionAttribute()
    {
        return $this->getAttribute('vision_' . app()->getLocale());
    }
    public function getHistoryAttribute()
    {
        return $this->getAttribute('history_' . app()->getLocale());
    }
    public function getLeadershipAttribute()
    {
        return $this->getAttribute('leadership_' . app()->getLocale());
    }
    public function getServicesAttribute()
    {
        return $this->getAttribute('services_' . app()->getLocale());
    }   
    public function getOurservicesAttribute()
    {
        return $this->getAttribute('our_services_' . app()->getLocale());
    }
    public function getCoursesAttribute()
    {
        return $this->getAttribute('courses_' . app()->getLocale());
    }
    public function getStudyprogramAttribute()
    {
        return $this->getAttribute('study_program_' . app()->getLocale());
    }
    public function getDigitalpsychologyAttribute()
    {
        return $this->getAttribute('digital_psychology_' . app()->getLocale());
    }
    public function getHumandesignAttribute()
    {
        return $this->getAttribute('human_design_' . app()->getLocale());
    }
    public function getMediaAttribute()
    {
        return $this->getAttribute('media_' . app()->getLocale());
    }
    public function getGalleryAttribute()
    {
        return $this->getAttribute('gallery_' . app()->getLocale());
    }
    public function getBlogsAttribute()
    {
        return $this->getAttribute('blogs_' . app()->getLocale());
    }
    public function getContactAttribute()
    {
        return $this->getAttribute('contact_' . app()->getLocale());
    }
    
}