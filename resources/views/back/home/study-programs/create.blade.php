@extends('back.layouts.master')
@section('title', 'Təhsil Proqramı Əlavə Et')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Başlık -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Təhsil Proqramı Əlavə Et</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home.study-programs.index') }}">Təhsil Proqramları</a></li>
                                <li class="breadcrumb-item active">Əlavə et</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" method="POST" action="{{ route('admin.home.study-programs.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Dil Sekmeleri -->
                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span>AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span>EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span>RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab İçerikleri -->
                                <div class="tab-content p-3">
                                    <!-- Azerbaycan Dili -->
                                    <div class="tab-pane active" id="az" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Ad (Az) <span class="text-danger">*</span></label>
                                            <input type="text" name="name_az" class="form-control" value="{{ old('name_az') }}" required>
                                            @error('name_az')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mətn (Az) <span class="text-danger">*</span></label>
                                            <textarea name="text_az" class="form-control summernote">{{ old('text_az') }}</textarea>
                                            @error('text_az')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Təsvir (Az) <span class="text-danger">*</span></label>
                                            <textarea name="description_az" class="form-control summernote">{{ old('description_az') }}</textarea>
                                            @error('description_az')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- İngilizce -->
                                    <div class="tab-pane" id="en" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Name (En) <span class="text-danger">*</span></label>
                                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" required>
                                            @error('name_en')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Text (En) <span class="text-danger">*</span></label>
                                            <textarea name="text_en" class="form-control summernote">{{ old('text_en') }}</textarea>
                                            @error('text_en')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (En) <span class="text-danger">*</span></label>
                                            <textarea name="description_en" class="form-control summernote">{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rusça -->
                                    <div class="tab-pane" id="ru" role="tabpanel">
                                        <div class="mb-3">
                                            <label class="form-label">Имя (Ru) <span class="text-danger">*</span></label>
                                            <input type="text" name="name_ru" class="form-control" value="{{ old('name_ru') }}" required>
                                            @error('name_ru')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Текст (Ru) <span class="text-danger">*</span></label>
                                            <textarea name="text_ru" class="form-control summernote">{{ old('text_ru') }}</textarea>
                                            @error('text_ru')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Описание (Ru) <span class="text-danger">*</span></label>
                                            <textarea name="description_ru" class="form-control summernote">{{ old('description_ru') }}</textarea>
                                            @error('description_ru')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Resim -->
                                <div class="mb-3">
                                    <label class="form-label">Şəkil</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Təsdiqlə
                                        </button>
                                        <a href="{{ route('admin.home.study-programs.index') }}" class="btn btn-secondary waves-effect">
                                            Ləğv et
                                        </a>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush