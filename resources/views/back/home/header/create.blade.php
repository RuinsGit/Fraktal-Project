@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Yeni Header</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.header.index') }}">Header</a></li>
                            <li class="breadcrumb-item active">Yeni</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.home.header.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="col-md-12 mb-3">
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content p-3 text-muted">
                                    <!-- AZ Tab -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ana Səhifə (AZ)</label>
                                                <input type="text" name="home_az" class="form-control @error('home_az') is-invalid @enderror" value="{{ old('home_az') }}">
                                                @error('home_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Haqqımızda (AZ)</label>
                                                <input type="text" name="about_az" class="form-control @error('about_az') is-invalid @enderror" value="{{ old('about_az') }}">
                                                @error('about_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vizyon (AZ)</label>
                                                <input type="text" name="vision_az" class="form-control @error('vision_az') is-invalid @enderror" value="{{ old (' vision_az') }}">
                                                @error('vision_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Tarix (AZ)</label>
                                                <input type="text" name="history_az" class="form-control @error('history_az') is-invalid @enderror" value="{{ old ('history_az') }}">
                                                @error('history_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Rəhbərlik (AZ)</label>
                                                <input type="text" name="leadership_az" class="form-control @error('leadership_az') is-invalid @enderror" value="{{ old('leadership_az') }}">
                                                @error('leadership_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Xidmətlər (AZ)</label>
                                                <input type="text" name="services_az" class="form-control @error('services_az') is-invalid @enderror" value="{{ old('services_az') }}">
                                                @error('services_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Bizim Xidmətlər (AZ)</label>
                                                <input type="text" name="our_services_az" class="form-control @error('our_services_az') is-invalid @enderror" value="{{ old('our_services_az') }}">
                                                @error('our_services_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Kurslar (AZ)</label>
                                                <input type="text" name="courses_az" class="form-control @error('courses_az') is-invalid @enderror" value="{{ old('courses_az') }}">
                                                @error('courses_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Təhsil Proqramı (AZ)</label>
                                                <input type="text" name="study_program_az" class="form-control @error('study_program_az') is-invalid @enderror" value="{{ old('study_program_az') }}">
                                                @error('study_program_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Rəqəmsal Psixologiya (AZ)</label>
                                                <input type="text" name="digital_psychology_az" class="form-control @error('digital_psychology_az') is-invalid @enderror" value="{{ old('digital_psychology_az') }}">
                                                @error('digital_psychology_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">İnsan Dizaynı (AZ)</label>
                                                <input type="text" name="human_design_az" class="form-control @error('human_design_az') is-invalid @enderror" value="{{ old('human_design_az') }}">
                                                @error('human_design_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Media (AZ)</label>
                                                <input type="text" name="media_az" class="form-control @error('media_az') is-invalid @enderror" value="{{ old('media_az') }}">
                                                @error('media_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Qalereya (AZ)</label>
                                                <input type="text" name="gallery_az" class="form-control @error('gallery_az') is-invalid @enderror" value="{{ old('gallery_az') }}">
                                                @error('gallery_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Bloqlar (AZ)</label>
                                                <input type="text" name="blogs_az" class="form-control @error('blogs_az') is-invalid @enderror" value="{{ old('blogs_az') }}">
                                                @error('blogs_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Əlaqə (AZ)</label>
                                                <input type="text" name="contact_az" class="form-control @error('contact_az') is-invalid @enderror" value="{{ old('contact_az') }}">
                                                @error('contact_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Home (EN)</label>
                                                <input type="text" name="home_en" class="form-control @error('home_en') is-invalid @enderror" value="{{ old('home_en') }}">
                                                @error('home_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">About Us (EN)</label>
                                                <input type="text" name="about_en" class="form-control @error('about_en') is-invalid @enderror" value="{{ old('about_en') }}">
                                                @error('about_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vision (EN)</label>
                                                <input type="text" name="vision_en" class="form-control @error('vision_en') is-invalid @enderror" value="{{ old('vision_en') }}">
                                                @error('vision_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">History (EN)</label>
                                                <input type="text" name="history_en" class="form-control @error('history_en') is-invalid @enderror" value="{{ old('history_en') }}">
                                                @error('history_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Leadership (EN)</label>
                                                <input type="text" name="leadership_en" class="form-control @error('leadership_en') is-invalid @enderror" value="{{ old('leadership_en') }}">
                                                @error('leadership_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Services (EN)</label>
                                                <input type="text" name="services_en" class="form-control @error('services_en') is-invalid @enderror" value="{{ old('services_en') }}">
                                                @error('services_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Our Services (EN)</label>
                                                <input type="text" name="our_services_en" class="form-control @error('our_services_en') is-invalid @enderror" value="{{ old('our_services_en') }}">
                                                @error('our_services_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Courses (EN)</label>
                                                <input type="text" name="courses_en" class="form-control @error('courses_en') is-invalid @enderror" value="{{ old('courses_en') }}">
                                                @error('courses_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Study Program (EN)</label>
                                                <input type="text" name="study_program_en" class="form-control @error('study_program_en') is-invalid @enderror" value="{{ old('study_program_en') }}">
                                                @error('study_program_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Digital Psychology (EN)</label>
                                                <input type="text" name="digital_psychology_en" class="form-control @error('digital_psychology_en') is-invalid @enderror" value="{{ old('digital_psychology_en') }}">
                                                @error('digital_psychology_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Human Design (EN)</label>
                                                <input type="text" name="human_design_en" class="form-control @error('human_design_en') is-invalid @enderror" value="{{ old('human_design_en') }}">
                                                @error('human_design_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Media (EN)</label>
                                                <input type="text" name="media_en" class="form-control @error('media_en') is-invalid @enderror" value="{{ old('media_en') }}">
                                                @error('media_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Gallery (EN)</label>
                                                <input type="text" name="gallery_en" class="form-control @error('gallery_en') is-invalid @enderror" value="{{ old('gallery_en') }}">
                                                @error('gallery_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Blogs (EN)</label>
                                                <input type="text" name="blogs_en" class="form-control @error('blogs_en') is-invalid @enderror" value="{{ old('blogs_en') }}">
                                                @error('blogs_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Contact (EN)</label>
                                                <input type="text" name="contact_en" class="form-control @error('contact_en') is-invalid @enderror" value="{{ old('contact_en') }}">
                                                @error('contact_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Главная (RU)</label>
                                                <input type="text" name="home_ru" class="form-control @error('home_ru') is-invalid @enderror" value="{{ old('home_ru') }}">
                                                @error('home_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">О нас (RU)</label>
                                                <input type="text" name="about_ru" class="form-control @error('about_ru') is-invalid @enderror" value="{{ old('about_ru') }}">
                                                @error('about_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Видение (RU)</label>
                                                <input type="text" name="vision_ru" class="form-control @error('vision_ru') is-invalid @enderror" value="{{ old('vision_ru') }}">
                                                @error('vision_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">История (RU)</label>
                                                <input type="text" name="history_ru" class="form-control @error('history_ru') is-invalid @enderror" value="{{ old('history_ru') }}">
                                                @error('history_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Руководство (RU)</label>
                                                <input type="text" name="leadership_ru" class="form-control @error('leadership_ru') is-invalid @enderror" value="{{ old('leadership_ru') }}">
                                                @error('leadership_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Услуги (RU)</label>
                                                <input type="text" name="services_ru" class="form-control @error('services_ru') is-invalid @enderror" value="{{ old('services_ru') }}">
                                                @error('services_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Наши Услуги (RU)</label>
                                                <input type="text" name="our_services_ru" class="form-control @error('our_services_ru') is-invalid @enderror" value="{{ old('our_services_ru') }}">
                                                @error('our_services_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Курсы (RU)</label>
                                                <input type="text" name="courses_ru" class="form-control @error('courses_ru') is-invalid @enderror" value="{{ old('courses_ru') }}">
                                                @error('courses_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Учебная Программа (RU)</label>
                                                <input type="text" name="study_program_ru" class="form-control @error('study_program_ru') is-invalid @enderror" value="{{ old('study_program_ru') }}">
                                                @error('study_program_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Цифровая Психология (RU)</label>
                                                <input type="text" name="digital_psychology_ru" class="form-control @error('digital_psychology_ru') is-invalid @enderror" value="{{ old('digital_psychology_ru') }}">
                                                @error('digital_psychology_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Дизайн Человека (RU)</label>
                                                <input type="text" name="human_design_ru" class="form-control @error('human_design_ru') is-invalid @enderror" value="{{ old('human_design_ru') }}">
                                                @error('human_design_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Медиа (RU)</label>
                                                <input type="text" name="media_ru" class="form-control @error('media_ru') is-invalid @enderror" value="{{ old('media_ru') }}">
                                                @error('media_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Галерея (RU)</label>
                                                <input type="text" name="gallery_ru" class="form-control @error('gallery_ru') is-invalid @enderror" value="{{ old('gallery_ru') }}">
                                                @error('gallery_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Блоги (RU)</label>
                                                <input type="text" name="blogs_ru" class="form-control @error('blogs_ru') is-invalid @enderror" value="{{ old('blogs_ru') }}">
                                                @error('blogs_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Контакты (RU)</label>
                                                <input type="text" name="contact_ru" class="form-control @error('contact_ru') is-invalid @enderror" value="{{ old('contact_ru') }}">
                                                @error('contact_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Logo</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                    <a href="{{ route('admin.home.header.index') }}" class="btn btn-secondary">Geri</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection