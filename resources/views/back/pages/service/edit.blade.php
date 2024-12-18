@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Xidmətlər</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.service.index') }}">Xidmətlər</a>
                                </li>
                                <li class="breadcrumb-item active">Redaktə et</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Xidmət redaktə et</h4>
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">EN</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">RU</span>
                                    </a>
                                </li>
                            </ul>
                            <form class="needs-validation" method="POST"
                                action="{{ route('admin.service.update', ['id' => $service->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="az">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Başlıq (Az)</label>
                                                    <input type="text" name="title_az" value="{{ $service->title_az }}" class="form-control">
                                                    @error('title_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mətn (Az)</label>
                                                    <textarea name="description_az" class="form-control summernote">{{ $service->description_az }}</textarea>
                                                    @error('description_az')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="en">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Başlıq (En)</label>
                                                    <input type="text" name="title_en" value="{{ $service->title_en }}" class="form-control">
                                                    @error('title_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mətn (En)</label>
                                                    <textarea name="description_en" class="form-control summernote">{{ $service->description_en }}</textarea>
                                                    @error('description_en')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="ru">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Başlıq (Ru)</label>
                                                    <input type="text" name="title_ru" value="{{ $service->title_ru }}" class="form-control">
                                                    @error('title_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mətn (Ru)</label>
                                                    <textarea name="description_ru" class="form-control summernote">{{ $service->description_ru }}</textarea>
                                                    @error('description_ru')
                                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Şəkil</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <div class="upload-container row mt-3">
                                                <div class="col-md-3 col-sm-6 mb-3">
                                                    <div class="upload-image" style="max-width: 200px; max-height: 200px; overflow: hidden;">
                                                        <img src="{{ asset($service->image) }}" alt="" 
                                                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                                    </div>
                                                </div>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Təsdiqlə</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('back/assets/js/pages/file-upload.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".summernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->

    <script src="{{ asset('back/assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $('select').select2();
    </script>
@endpush
