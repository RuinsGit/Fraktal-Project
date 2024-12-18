@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Başlık Kısmı -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Header</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">Header</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if($headers->isEmpty())
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.home.header.create') }}" class="btn btn-primary mb-3">
                                <i class="mdi mdi-plus"></i> Yeni Header Ekle
                            </a>
                            <div class="alert alert-info">
                                Henüz header bilgisi eklenmemiş.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Dil Sekmeleri -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified mb-3" role="tablist">
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

                            <div class="tab-content">
                                <!-- AZ Tab -->
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    @foreach($headers as $header)
                                        <!-- Üst Kısım -->
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th width="15%">Logo</th>
                                                                <th>Ana Səhifə</th>
                                                                <th>Haqqımızda</th>
                                                                <th>Vizyon</th>
                                                                <th>Tarix</th>
                                                                <th>Rəhbərlik</th>
                                                                <th>Xidmətlər</th>
                                                                <th>Bizim Xidmətlər</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 150px; vertical-align: middle; text-align: center;">
                                                                    @if($header->image)
                                                                        <img src="{{ asset($header->image) }}" alt="Header Image" style="width: 100%; height: auto; object-fit: cover; border-radius: 5px; max-height: 100px;">
                                                                    @else
                                                                        <span class="text-muted">Resim yok</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $header->home_az }}</td>
                                                                <td>{{ $header->about_az }}</td>
                                                                <td>{{ $header->vision_az }}</td>
                                                                <td>{{ $header->history_az }}</td>
                                                                <td>{{ $header->leadership_az }}</td>
                                                                <td>{{ $header->services_az }}</td>
                                                                <td>{{ $header->our_services_az }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Alt Kısım -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Kurslar</th>
                                                                <th>Təhsil Proqramı</th>
                                                                <th>Rəqəmsal Psixologiya</th>
                                                                <th>İnsan Dizaynı</th>
                                                                <th>Media</th>
                                                                <th>Qalereya</th>
                                                                <th>Bloqlar</th>
                                                                <th>Əlaqə</th>
                                                                <th width="15%">Əməliyyatlar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $header->courses_az }}</td>
                                                                <td>{{ $header->study_program_az }}</td>
                                                                <td>{{ $header->digital_psychology_az }}</td>
                                                                <td>{{ $header->human_design_az }}</td>
                                                                <td>{{ $header->media_az }}</td>
                                                                <td>{{ $header->gallery_az }}</td>
                                                                <td>{{ $header->blogs_az }}</td>
                                                                <td>{{ $header->contact_az }}</td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a href="{{ route('admin.home.header.edit', $header->id) }}" class="btn btn-success btn-sm">
                                                                            <i class="mdi mdi-pencil"></i>
                                                                        </a>
                                                                        
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- EN Tab -->
                                <div class="tab-pane" id="en" role="tabpanel">
                                    @foreach($headers as $header)
                                        <!-- Üst Kısım -->
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th width="15%">Logo</th>
                                                                <th>Home</th>
                                                                <th>About Us</th>
                                                                <th>Vision</th>
                                                                <th>History</th>
                                                                <th>Leadership</th>
                                                                <th>Services</th>
                                                                <th>Our Services</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                            <td style="width: 150px; vertical-align: middle; text-align: center;">
                                                                    @if($header->image)
                                                                        <img src="{{ asset($header->image) }}" alt="Header Image" style="width: 100%; height: auto; object-fit: cover; border-radius: 5px; max-height: 100px;">
                                                                    @else
                                                                        <span class="text-muted">Resim yok</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $header->home_en }}</td>
                                                                <td>{{ $header->about_en }}</td>
                                                                <td>{{ $header->vision_en }}</td>
                                                                <td>{{ $header->history_en }}</td>
                                                                <td>{{ $header->leadership_en }}</td>
                                                                <td>{{ $header->services_en }}</td>
                                                                <td>{{ $header->our_services_en }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Alt Kısım -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Courses</th>
                                                                <th>Study Program</th>
                                                                <th>Digital Psychology</th>
                                                                <th>Human Design</th>
                                                                <th>Media</th>
                                                                <th>Gallery</th>
                                                                <th>Blogs</th>
                                                                <th>Contact</th>
                                                                <th width="15%">Operations</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $header->courses_en }}</td>
                                                                <td>{{ $header->study_program_en }}</td>
                                                                <td>{{ $header->digital_psychology_en }}</td>
                                                                <td>{{ $header->human_design_en }}</td>
                                                                <td>{{ $header->media_en }}</td>
                                                                <td>{{ $header->gallery_en }}</td>
                                                                <td>{{ $header->blogs_en }}</td>
                                                                <td>{{ $header->contact_en }}</td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a href="{{ route('admin.home.header.edit', $header->id) }}" class="btn btn-success btn-sm">
                                                                            <i class="mdi mdi-pencil"></i>
                                                                        </a>
                                                                        
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- RU Tab -->
                                <div class="tab-pane" id="ru" role="tabpanel">
                                    @foreach($headers as $header)
                                        <!-- Üst Kısım -->
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th width="15%">Логотип</th>
                                                                <th>Главная</th>
                                                                <th>О нас</th>
                                                                <th>Видение</th>
                                                                <th>История</th>
                                                                <th>Руководство</th>
                                                                <th>Услуги</th>
                                                                <th>Наши Услуги</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                            <td style="width: 150px; vertical-align: middle; text-align: center;">
                                                                    @if($header->image)
                                                                        <img src="{{ asset($header->image) }}" alt="Header Image" style="width: 100%; height: auto; object-fit: cover; border-radius: 5px; max-height: 100px;">
                                                                    @else
                                                                        <span class="text-muted">Resim yok</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $header->home_ru }}</td>
                                                                <td>{{ $header->about_ru }}</td>
                                                                <td>{{ $header->vision_ru }}</td>
                                                                <td>{{ $header->history_ru }}</td>
                                                                <td>{{ $header->leadership_ru }}</td>
                                                                <td>{{ $header->services_ru }}</td>
                                                                <td>{{ $header->our_services_ru }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Alt Kısım -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Курсы</th>
                                                                <th>Учебная Программа</th>
                                                                <th>Цифровая Психология</th>
                                                                <th>Дизайн Человека</th>
                                                                <th>Медиа</th>
                                                                <th>Галерея</th>
                                                                <th>Блоги</th>
                                                                <th>Контакты</th>
                                                                <th width="15%">Операции</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $header->courses_ru }}</td>
                                                                <td>{{ $header->study_program_ru }}</td>
                                                                <td>{{ $header->digital_psychology_ru }}</td>
                                                                <td>{{ $header->human_design_ru }}</td>
                                                                <td>{{ $header->media_ru }}</td>
                                                                <td>{{ $header->gallery_ru }}</td>
                                                                <td>{{ $header->blogs_ru }}</td>
                                                                <td>{{ $header->contact_ru }}</td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a href="{{ route('admin.home.header.edit', $header->id) }}" class="btn btn-success btn-sm">
                                                                            <i class="mdi mdi-pencil"></i>
                                                                        </a>
                                                                        
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .table-responsive {
        margin: 0;
    }
    .table {
        margin-bottom: 0;
    }
    .table > :not(caption) > * > * {
        padding: 0.75rem;
        vertical-align: middle;
    }
    .table-striped > tbody > tr:nth-of-type(odd) > * {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .table-light {
        background-color: #f8f9fa;
    }
    .img-fluid {
        max-width: 100px;
        height: auto;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .gap-2 {
        gap: 0.5rem!important;
    }
</style>
@endpush
@endsection