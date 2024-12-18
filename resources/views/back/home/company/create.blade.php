@extends('back.layouts.master')

@section('title', 'Yeni Şirkət')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Şirkət</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.home.company.index') }}">Şirkətlər</a></li>
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
                            <form action="{{ route('admin.home.company.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Şirkət Məlumatları</h4>
                                                <p class="card-title-desc">Şirkət haqqında ətraflı məlumat</p>

                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                            <span class="d-none d-sm-block">Az</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                            <span class="d-none d-sm-block">En</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                            <span class="d-none d-sm-block">Ru</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content p-3 text-muted">
                                                    <div class="tab-pane active" id="az" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label class="form-label">Ad 1 (AZ)</label>
                                                            <input type="text" name="name_1_az" class="form-control" placeholder="Ad 1 (AZ)" value="{{ old('name_1_az') }}">
                                                            @error('name_1_az')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Ad 2 (AZ)</label>
                                                            <input type="text" name="name_2_az" class="form-control" placeholder="Ad 2 (AZ)" value="{{ old('name_2_az') }}">
                                                            @error('name_2_az')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="en" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label class="form-label">Ad 1 (EN)</label>
                                                            <input type="text" name="name_1_en" class="form-control" placeholder="Ad 1 (EN)" value="{{ old('name_1_en') }}">
                                                            @error('name_1_en')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Ad 2 (EN)</label>
                                                            <input type="text" name="name_2_en" class="form-control" placeholder="Ad 2 (EN)" value="{{ old('name_2_en') }}">
                                                            @error('name_2_en')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="ru" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label class="form-label">Ad 1 (RU)</label>
                                                            <input type="text" name="name_1_ru" class="form-control" placeholder="Ad 1 (RU)" value="{{ old('name_1_ru') }}">
                                                            @error('name_1_ru')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Ad 2 (RU)</label>
                                                            <input type="text" name="name_2_ru" class="form-control" placeholder="Ad 2 (RU)" value="{{ old('name_2_ru') }}">
                                                            @error('name_2_ru')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Şəkil</label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="1">Aktiv</option>
                                                <option value="0">Deaktiv</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('admin.home.company.index') }}" class="btn btn-secondary">Geri</a>
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

@push('css')
    <link href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if($errors->any())
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Xəta!',
                html: '@foreach($errors->all() as $error){{ $error }}<br>@endforeach',
                showConfirmButton: true,
                confirmButtonText: 'Tamam'
            });
        </script>
    @endif
@endpush