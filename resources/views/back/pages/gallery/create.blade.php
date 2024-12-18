@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Qalereya</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Qalereya</a></li>
                                <li class="breadcrumb-item active">Əlavə et</li>
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
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <h4 class="card-title">Qalereya əlavə et</h4>
                            
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

                            <form class="needs-validation" method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="az">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Başlıq (Az)</label>
                                                    <input type="text" name="title_az" value="{{ old('title_az') }}" class="form-control">
                                                    @error('title_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="en">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Başlıq (En)</label>
                                                    <input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control">
                                                    @error('title_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="ru">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Başlıq (Ru)</label>
                                                    <input type="text" name="title_ru" value="{{ old('title_ru') }}" class="form-control">
                                                    @error('title_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ana Şəkil</label>
                                    <input type="file" name="main_image" class="form-control" accept="image/*">
                                    @error('main_image')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alt Şəkillər</label>
                                    <div id="image-container">
                                        <div class="image-upload-group mb-2">
                                            <div class="row align-items-center">
                                                <div class="col-md-10">
                                                    <input type="file" name="sub_images[]" class="form-control" accept="image/*">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-success add-image-btn">
                                                        <i class="mdi mdi-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="preview mt-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Təsdiqlə
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
    <link href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/image-uploader/1.2.3/image-uploader.min.css">
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/pages/file-upload.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/image-uploader/1.2.3/image-uploader.min.js"></script>
    
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
            $('form').on('submit', function(e) {
                let hasError = false;
                let errorMessage = '';

                // AZ tab kontrolü
                if (!$('#az input[name="title_az"]').val()) {
                    errorMessage += 'Azərbaycan dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // EN tab kontrolü
                if (!$('#en input[name="title_en"]').val()) {
                    errorMessage += 'İngilis dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // RU tab kontrolü
                if (!$('#ru input[name="title_ru"]').val()) {
                    errorMessage += 'Rus dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // Şəkil kontrolü
                if (!$('input[name="main_image"]').val()) {
                    errorMessage += 'Ana Şəkil seçilməlidir<br>';
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
                        confirmButtonText: 'Tamam',
                        timer: 5000
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Resim önizleme fonksiyonu
            function previewImage(input) {
                const preview = input.closest('.image-upload-group').querySelector('.preview');
                preview.innerHTML = '';

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '200px';
                        img.style.marginTop = '10px';
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Yeni resim input grubu ekleme
            document.querySelector('.add-image-btn').addEventListener('click', function() {
                const container = document.getElementById('image-container');
                const newGroup = document.createElement('div');
                newGroup.className = 'image-upload-group mb-2';
                newGroup.innerHTML = `
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            <input type="file" name="sub_images[]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-image-btn">
                                <i class="mdi mdi-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="preview mt-2"></div>
                `;
                container.appendChild(newGroup);

                // Yeni eklenen input için event listener
                newGroup.querySelector('input[type="file"]').addEventListener('change', function() {
                    previewImage(this);
                });
            });

            // Mevcut input için event listener
            document.querySelector('input[name="sub_images[]"]').addEventListener('change', function() {
                previewImage(this);
            });

            // Resim grubunu kaldırma
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-image-btn')) {
                    e.target.closest('.image-upload-group').remove();
                }
            });
        });
    </script>
@endpush