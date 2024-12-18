@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Yeni Blog</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Bloglar</a></li>
                                <li class="breadcrumb-item active">Yeni</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header bg-soft-primary">
                            <h5 class="card-title mb-0">Blog Məlumatları</h5>
                        </div>
                        
                        <div class="card-body">
                            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Status</label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                                <option value="0">Deaktiv</option>
                                                <option value="1" selected>Aktiv</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Şəkil</label>
                                            <input type="file" 
                                                   name="image" 
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   accept="image/*">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Blog Növü <span class="text-danger">*</span></label>
                                            <select name="blog_type_id" class="form-select @error('blog_type_id') is-invalid @enderror">
                                                <option value="">Blog növü seçin</option>
                                                @foreach($blogTypes as $type)
                                                    <option value="{{ $type->id }}" {{ old('blog_type_id') == $type->id ? 'selected' : '' }}>
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('blog_type_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
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

                                        <div class="tab-content p-3">
                                            @foreach(['az', 'en', 'ru'] as $lang)
                                                <div class="tab-pane {{ $lang === 'az' ? 'active' : '' }}" 
                                                     id="{{ $lang }}" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <div class="form-group">
                                                                <label class="form-label fw-bold">Başlıq ({{ strtoupper($lang) }})</label>
                                                                <input type="text" 
                                                                       name="title_{{ $lang }}"
                                                                       value="{{ old('title_' . $lang) }}"
                                                                       class="form-control @error('title_' . $lang) is-invalid @enderror">
                                                                @error('title_' . $lang)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mb-4">
                                                            <div class="form-group">
                                                                <label class="form-label fw-bold">Mətn ({{ strtoupper($lang) }})</label>
                                                                <textarea name="description_{{ $lang }}"
                                                                          class="form-control summernote @error('description_' . $lang) is-invalid @enderror"
                                                                          rows="5">{{ old('description_' . $lang) }}</textarea>
                                                                @error('description_' . $lang)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <i class="fas fa-save me-2"></i>Yadda saxla
                                        </button>
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
    <link href="{{ asset('back/assets/libs/summernote/summernote-lite.min.css') }}" rel="stylesheet">
    <style>
        .nav-tabs-custom .nav-item .nav-link {
            padding: 1rem;
        }
        .nav-tabs-custom .nav-item .nav-link.active {
            color: #556ee6;
            background: rgba(85,110,230,.1);
        }
        .form-label {
            margin-bottom: 0.5rem;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/summernote/summernote-lite.min.js') }}"></script>
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

    <!-- Form submit kontrolü -->
    <script>
        $(document).ready(function() {
            // Summernote
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Form validation ve submit
            $('form').on('submit', function(e) {
                e.preventDefault();
                let hasError = false;
                let errorMessage = '';

                // Blog türü kontrolü
                if (!$('select[name="blog_type_id"]').val()) {
                    errorMessage += 'Blog növü seçilməlidir<br>';
                    hasError = true;
                }

                // AZ tab kontrolü
                if (!$('#az input[name="title_az"]').val() || !$('#az textarea[name="description_az"]').val()) {
                    errorMessage += 'Azərbaycan dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // EN tab kontrolü
                if (!$('#en input[name="title_en"]').val() || !$('#en textarea[name="description_en"]').val()) {
                    errorMessage += 'İngilis dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // RU tab kontrolü
                if (!$('#ru input[name="title_ru"]').val() || !$('#ru textarea[name="description_ru"]').val()) {
                    errorMessage += 'Rus dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // Resim kontrolü
                if (!$('input[name="image"]').val()) {
                    errorMessage += 'Şəkil seçin<br>';
                    hasError = true;
                }

                if (hasError) {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Diqqət!',
                        html: errorMessage,
                        showConfirmButton: true,
                        confirmButtonText: 'Tamam',
                        timer: 5000
                    });
                    return;
                }

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu!',
                            text: 'Blog müvəffəqiyyətlə əlavə edildi',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "{{ route('admin.blog.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Xəta!',
                            text: xhr.responseJSON?.message || 'Xəta baş verdi',
                            confirmButtonText: 'Tamam'
                        });
                    }
                });
            });
        });
    </script>
@endpush
