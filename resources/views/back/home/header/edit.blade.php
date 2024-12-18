@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Header Düzenle</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.header.index') }}">Header</a></li>
                            <li class="breadcrumb-item active">Düzenle</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.home.header.update', $header->id) }}" method="POST" enctype="multipart/form-data">
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
                                                <input type="text" name="home_az" class="form-control" value="{{ $header->home_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Haqqımızda (AZ)</label>
                                                <input type="text" name="about_az" class="form-control" value="{{ $header->about_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vizyon (AZ)</label>
                                                <input type="text" name="vision_az" class="form-control" value="{{ $header->vision_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Tarix (AZ)</label>
                                                <input type="text" name="history_az" class="form-control" value="{{ $header->history_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Rəhbərlik (AZ)</label>
                                                <input type="text" name="leadership_az" class="form-control" value="{{ $header->leadership_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Xidmətlər (AZ)</label>
                                                <input type="text" name="services_az" class="form-control" value="{{ $header->services_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Bizim Xidmətlər (AZ)</label>
                                                <input type="text" name="our_services_az" class="form-control" value="{{ $header->our_services_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Kurslar (AZ)</label>
                                                <input type="text" name="courses_az" class="form-control" value="{{ $header->courses_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Təhsil Proqramı (AZ)</label>
                                                <input type="text" name="study_program_az" class="form-control" value="{{ $header->study_program_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Rəqəmsal Psixologiya (AZ)</label>
                                                <input type="text" name="digital_psychology_az" class="form-control" value="{{ $header->digital_psychology_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">İnsan Dizaynı (AZ)</label>
                                                <input type="text" name="human_design_az" class="form-control" value="{{ $header->human_design_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Media (AZ)</label>
                                                <input type="text" name="media_az" class="form-control" value="{{ $header->media_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Qalereya (AZ)</label>
                                                <input type="text" name="gallery_az" class="form-control" value="{{ $header->gallery_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Bloqlar (AZ)</label>
                                                <input type="text" name="blogs_az" class="form-control" value="{{ $header->blogs_az }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Əlaqə (AZ)</label>
                                                <input type="text" name="contact_az" class="form-control" value="{{ $header->contact_az }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EN Tab -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Home (EN)</label>
                                                <input type="text" name="home_en" class="form-control" value="{{ $header->home_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">About Us (EN)</label>
                                                <input type="text" name="about_en" class="form-control" value="{{ $header->about_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vision (EN)</label>
                                                <input type="text" name="vision_en" class="form-control" value="{{ $header->vision_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">History (EN)</label>
                                                <input type="text" name="history_en" class="form-control" value="{{ $header->history_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Leadership (EN)</label>
                                                <input type="text" name="leadership_en" class="form-control" value="{{ $header->leadership_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Services (EN)</label>
                                                <input type="text" name="services_en" class="form-control" value="{{ $header->services_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Our Services (EN)</label>
                                                <input type="text" name="our_services_en" class="form-control" value="{{ $header->our_services_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Courses (EN)</label>
                                                <input type="text" name="courses_en" class="form-control" value="{{ $header->courses_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Study Program (EN)</label>
                                                <input type="text" name="study_program_en" class="form-control" value="{{ $header->study_program_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Digital Psychology (EN)</label>
                                                <input type="text" name="digital_psychology_en" class="form-control" value="{{ $header->digital_psychology_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Human Design (EN)</label>
                                                <input type="text" name="human_design_en" class="form-control" value="{{ $header->human_design_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Media (EN)</label>
                                                <input type="text" name="media_en" class="form-control" value="{{ $header->media_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Gallery (EN)</label>
                                                <input type="text" name="gallery_en" class="form-control" value="{{ $header->gallery_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Blogs (EN)</label>
                                                <input type="text" name="blogs_en" class="form-control" value="{{ $header->blogs_en }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Contact (EN)</label>
                                                <input type="text" name="contact_en" class="form-control" value="{{ $header->contact_en }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RU Tab -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Главная (RU)</label>
                                                <input type="text" name="home_ru" class="form-control" value="{{ $header->home_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">О нас (RU)</label>
                                                <input type="text" name="about_ru" class="form-control" value="{{ $header->about_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Видение (RU)</label>
                                                <input type="text" name="vision_ru" class="form-control" value="{{ $header->vision_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">История (RU)</label>
                                                <input type="text" name="history_ru" class="form-control" value="{{ $header->history_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Руководство (RU)</label>
                                                <input type="text" name="leadership_ru" class="form-control" value="{{ $header->leadership_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Услуги (RU)</label>
                                                <input type="text" name="services_ru" class="form-control" value="{{ $header->services_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Наши Услуги (RU)</label>
                                                <input type="text" name="our_services_ru" class="form-control" value="{{ $header->our_services_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Курсы (RU)</label>
                                                <input type="text" name="courses_ru" class="form-control" value="{{ $header->courses_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Учебная Программа (RU)</label>
                                                <input type="text" name="study_program_ru" class="form-control" value="{{ $header->study_program_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Цифровая Психология (RU)</label>
                                                <input type="text" name="digital_psychology_ru" class="form-control" value="{{ $header->digital_psychology_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Дизайн Человека (RU)</label>
                                                <input type="text" name="human_design_ru" class="form-control" value="{{ $header->human_design_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Медиа (RU)</label>
                                                <input type="text" name="media_ru" class="form-control" value="{{ $header->media_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Галерея (RU)</label>
                                                <input type="text" name="gallery_ru" class="form-control" value="{{ $header->gallery_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Блоги (RU)</label>
                                                <input type="text" name="blogs_ru" class="form-control" value="{{ $header->blogs_ru }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Контакты (RU)</label>
                                                <input type="text" name="contact_ru" class="form-control" value="{{ $header->contact_ru }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Logo</label>
                                @if($header->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($header->image) }}" alt="Mevcut Logo" style="max-width: 200px">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control">
                                <small class="text-muted">Yeni bir logo yüklemek istemiyorsanız boş bırakın</small>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
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