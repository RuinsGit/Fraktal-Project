@extends('back.layouts.master')
@section('title', 'Üstünlük Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Üstünlük Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.home.advantages.index') }}">Üstünlüklərimiz</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.home.advantages.update', $advantage->id) }}" method="POST" enctype="multipart/form-data">
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
                                                <!-- AZ Tab -->
                                                <div class="tab-pane active" id="az" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Ad (AZ)</label>
                                                                <input type="text" name="name_az" class="form-control @error('name_az') is-invalid @enderror" value="{{ old('name_az', $advantage->name_az) }}">
                                                                @error('name_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Mətn (AZ)</label>
                                                                <textarea name="text_az" class="form-control @error('text_az') is-invalid @enderror" rows="5">{{ old('text_az', $advantage->text_az) }}</textarea>
                                                                @error('text_az')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- EN Tab -->
                                                <div class="tab-pane" id="en" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name (EN)</label>
                                                                <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en', $advantage->name_en) }}">
                                                                @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Text (EN)</label>
                                                                <textarea name="text_en" class="form-control @error('text_en') is-invalid @enderror" rows="5">{{ old('text_en', $advantage->text_en) }}</textarea>
                                                                @error('text_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- RU Tab -->
                                                <div class="tab-pane" id="ru" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Имя (RU)</label>
                                                                <input type="text" name="name_ru" class="form-control @error('name_ru') is-invalid @enderror" value="{{ old('name_ru', $advantage->name_ru) }}">
                                                                @error('name_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Текст (RU)</label>
                                                                <textarea name="text_ru" class="form-control @error('text_ru') is-invalid @enderror" rows="5">{{ old('text_ru', $advantage->text_ru) }}</textarea>
                                                                @error('text_ru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Şəkil</label>
                                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                <div class="mt-2">
                                                    <img src="{{ asset($advantage->image) }}" alt="Image" width="100">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                    <option value="1" {{ old('status', $advantage->status) == 1 ? 'selected' : '' }}>Aktiv</option>
                                                    <option value="0" {{ old('status', $advantage->status) == 0 ? 'selected' : '' }}>Deaktiv</option>
                                                </select>
                                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('admin.home.advantages.index') }}" class="btn btn-secondary">Geri</a>
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

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if($errors->any())
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Xəta!',
                html: `
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                `,
                showConfirmButton: true,
                confirmButtonText: 'Tamam'
            });
        </script>
    @endif
@endpush