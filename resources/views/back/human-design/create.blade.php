@extends('back.layouts.master')
@section('title', 'Yeni İnsan Dizaynı')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Yeni İnsan Dizaynı</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.human-design.index') }}">İnsan Dizaynı</a>
                                </li>
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
                            <form action="{{ route('admin.human-design.store') }}" method="POST">
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
                                                <div class="tab-pane active" id="az" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label class="form-label">Ad (AZ)</label>
                                                        <input type="text" name="name_az" class="form-control @error('name_az') is-invalid @enderror" value="{{ old('name_az') }}">
                                                        @error('name_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Mətn (AZ)</label>
                                                        <textarea name="text_az" class="form-control @error('text_az') is-invalid @enderror">{{ old('text_az') }}</textarea>
                                                        @error('text_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Təsvir (AZ)</label>
                                                        <textarea name="description_az" class="form-control @error('description_az') is-invalid @enderror">{{ old('description_az') }}</textarea>
                                                        @error('description_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="en" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name (EN)</label>
                                                        <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}">
                                                        @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Text (EN)</label>
                                                        <textarea name="text_en" class="form-control @error('text_en') is-invalid @enderror">{{ old('text_en') }}</textarea>
                                                        @error('text_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Description (EN)</label>
                                                        <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>
                                                        @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="ru" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label class="form-label">Имя (RU)</label>
                                                        <input type="text" name="name_ru" class="form-control @error('name_ru') is-invalid @enderror" value="{{ old('name_ru') }}">
                                                        @error('name_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Текст (RU)</label>
                                                        <textarea name="text_ru" class="form-control @error('text_ru') is-invalid @enderror">{{ old('text_ru') }}</textarea>
                                                        @error('text_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Описание (RU)</label>
                                                        <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror">{{ old('description_ru') }}</textarea>
                                                        @error('description_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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