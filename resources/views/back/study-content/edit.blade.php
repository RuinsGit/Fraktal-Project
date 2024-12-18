@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Təhsil Məzmunu</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.study-content.index') }}">Təhsil Məzmunu</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert mesajları -->
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Təhsil Məzmunu redaktə</h4>
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

                            <form class="needs-validation" method="POST" action="{{ route('admin.study-content.update', $studyContent->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="az">
                                        <div class="mb-3">
                                            <label class="form-label">Mətn (Az)</label>
                                            <input type="text" name="text_az" value="{{ old('text_az', $studyContent->text_az) }}" class="form-control">
                                            @error('text_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Təsvir (Az)</label>
                                            <textarea name="description_az" class="form-control summernote">{{ old('description_az', $studyContent->description_az) }}</textarea>
                                            @error('description_az')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="en">
                                        <div class="mb-3">
                                            <label class="form-label">Text (En)</label>
                                            <input type="text" name="text_en" value="{{ old('text_en', $studyContent->text_en) }}" class="form-control">
                                            @error('text_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (En)</label>
                                            <textarea name="description_en" class="form-control summernote">{{ old('description_en', $studyContent->description_en) }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="ru">
                                        <div class="mb-3">
                                            <label class="form-label">Текст (Ru)</label>
                                            <input type="text" name="text_ru" value="{{ old('text_ru', $studyContent->text_ru) }}" class="form-control">
                                            @error('text_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Описание (Ru)</label>
                                            <textarea name="description_ru" class="form-control summernote">{{ old('description_ru', $studyContent->description_ru) }}</textarea>
                                            @error('description_ru')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mövcud Şəkil</label>
                                    <div class="mb-3">
                                        <img src="{{ asset('uploads/study-content/' . $studyContent->image) }}" alt="image" width="100">
                                    </div>
                                    <label class="form-label">Yeni Şəkil</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', $studyContent->status) == 1 ? 'selected' : '' }}>Aktiv</option>
                                        <option value="0" {{ old('status', $studyContent->status) == 0 ? 'selected' : '' }}>Deaktiv</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Yadda saxla</button>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('back/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/pages/file-upload.js') }}"></script>
    
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

            $('form').on('submit', function(e) {
                let hasError = false;
                let errorMessage = '';

                if (!$('#az input[name="text_az"]').val().trim()) {
                    errorMessage += 'Azərbaycan dilində mətn daxil edin<br>';
                    hasError = true;
                }
                if (!$('#en input[name="text_en"]').val().trim()) {
                    errorMessage += 'İngilis dilində mətn daxil edin<br>';
                    hasError = true;
                }
                if (!$('#ru input[name="text_ru"]').val().trim()) {
                    errorMessage += 'Rus dilində mətn daxil edin<br>';
                    hasError = true;
                }

                if (!$('#az textarea[name="description_az"]').val().trim()) {
                    errorMessage += 'Azərbaycan dilində təsvir daxil edin<br>';
                    hasError = true;
                }
                if (!$('#en textarea[name="description_en"]').val().trim()) {
                    errorMessage += 'İngilis dilində təsvir daxil edin<br>';
                    hasError = true;
                }
                if (!$('#ru textarea[name="description_ru"]').val().trim()) {
                    errorMessage += 'Rus dilində təsvir daxil edin<br>';
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Diqqət!',
                        html: errorMessage,
                        showConfirmButton: true,
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if(session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Uğurlu!',
                text: "{{ session('success') }}",
                showConfirmButton: true,
                confirmButtonText: 'Tamam',
                timer: 3000
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Xəta!',
                text: "{{ session('error') }}",
                showConfirmButton: true,
                confirmButtonText: 'Tamam',
                timer: 3000
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Diqqət!',
                html: `
                    <div style="text-align: left;">
                        Zəhmət olmasa, bütün dillərdə məlumatları daxil edin:<br><br>
                        @foreach($errors->all() as $error)
                            - {{ $error }}<br>
                        @endforeach
                    </div>
                `,
                showConfirmButton: true,
                confirmButtonText: 'Tamam',
                timer: 5000
            });
        </script>
    @endif
@endpush