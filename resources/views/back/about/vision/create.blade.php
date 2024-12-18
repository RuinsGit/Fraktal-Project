@extends('back.layouts.master')
@section('title', 'Yeni Vizyon')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni Vizyon</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.about.vision.index') }}">Vizyonumuz</a></li>
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
                            <form action="{{ route('admin.about.vision.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
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

                                            <div class="tab-content p-3 text-muted">
                                                <!-- Az Tab -->
                                                <div class="tab-pane active" id="az" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label class="form-label">Ad 1 (AZ)</label>
                                                        <input type="text" name="name_1_az" class="form-control @error('name_1_az') is-invalid @enderror" value="{{ old('name_1_az') }}">
                                                        @error('name_1_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Mətn 1 (AZ)</label>
                                                        <textarea name="text_1_az" class="form-control @error('text_1_az') is-invalid @enderror">{{ old('text_1_az') }}</textarea>
                                                        @error('text_1_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Ad 2 (AZ)</label>
                                                        <input type="text" name="name_2_az" class="form-control @error('name_2_az') is-invalid @enderror" value="{{ old('name_2_az') }}">
                                                        @error('name_2_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Mətn 2 (AZ)</label>
                                                        <textarea name="text_2_az" class="form-control @error('text_2_az') is-invalid @enderror">{{ old('text_2_az') }}</textarea>
                                                        @error('text_2_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>

                                                <!-- En Tab -->
                                                <div class="tab-pane" id="en" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name 1 (EN)</label>
                                                        <input type="text" name="name_1_en" class="form-control @error('name_1_en') is-invalid @enderror" value="{{ old('name_1_en') }}">
                                                        @error('name_1_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Text 1 (EN)</label>
                                                        <textarea name="text_1_en" class="form-control @error('text_1_en') is-invalid @enderror">{{ old('text_1_en') }}</textarea>
                                                        @error('text_1_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Name 2 (EN)</label>
                                                        <input type="text" name="name_2_en" class="form-control @error('name_2_en') is-invalid @enderror" value="{{ old('name_2_en') }}">
                                                        @error('name_2_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Text 2 (EN)</label>
                                                        <textarea name="text_2_en" class="form-control @error('text_2_en') is-invalid @enderror">{{ old('text_2_en') }}</textarea>
                                                        @error('text_2_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>

                                                <!-- Ru Tab -->
                                                <div class="tab-pane" id="ru" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label class="form-label">Имя 1 (RU)</label>
                                                        <input type="text" name="name_1_ru" class="form-control @error('name_1_ru') is-invalid @enderror" value="{{ old('name_1_ru') }}">
                                                        @error('name_1_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Текст 1 (RU)</label>
                                                        <textarea name="text_1_ru" class="form-control @error('text_1_ru') is-invalid @enderror">{{ old('text_1_ru') }}</textarea>
                                                        @error('text_1_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Имя 2 (RU)</label>
                                                        <input type="text" name="name_2_ru" class="form-control @error('name_2_ru') is-invalid @enderror" value="{{ old('name_2_ru') }}">
                                                        @error('name_2_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Текст 2 (RU)</label>
                                                        <textarea name="text_2_ru" class="form-control @error('text_2_ru') is-invalid @enderror">{{ old('text_2_ru') }}</textarea>
                                                        @error('text_2_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">İkon 1</label>
                                    <input type="file" name="icon_1" class="form-control @error('icon_1') is-invalid @enderror">
                                    @error('icon_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">İkon 2</label>
                                    <input type="file" name="icon_2" class="form-control @error('icon_2') is-invalid @enderror">
                                    @error('icon_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Şəkil</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktiv</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Deaktiv</option>
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                    <a href="{{ route('admin.about.vision.index') }}" class="btn btn-secondary">Geri</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('back/assets/js/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 300,
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>
@endpush