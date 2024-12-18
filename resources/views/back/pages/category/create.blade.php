@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kateqoriyalar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Kateqoriyalar</a>
                                </li>
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

                            <h4 class="card-title">Kateqoriya əlavə et</h4>
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
                            <form class="needs-validation" method="POST" action="{{ route('admin.category.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="az">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Ad (Az)</label>
                                                    <input type="text" name="name_az" value="{{ old('name_az') }}"
                                                        class="form-control">
                                                    @error('name_az')
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
                                                    <label for="validationCustom03" class="form-label">Ad (En)</label>
                                                    <input type="text" name="name_en" value="{{ old('name_en') }}"
                                                        class="form-control">
                                                    @error('name_en')
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
                                                    <label for="validationCustom03" class="form-label">Ad (Ru)</label>
                                                    <input type="text" name="name_ru" value="{{ old('name_ru') }}"
                                                        class="form-control">
                                                    @error('name_ru')
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
    <link href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/pages/file-upload.js') }}"></script>
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
            $('form').on('submit', function(e) {
                e.preventDefault();
                let hasError = false;
                let errorMessage = '';

                // AZ tab kontrolü
                if (!$('#az input[name="name_az"]').val()) {
                    errorMessage += 'Azərbaycan dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // EN tab kontrolü
                if (!$('#en input[name="name_en"]').val()) {
                    errorMessage += 'İngilis dilində məlumatları daxil edin<br>';
                    hasError = true;
                }

                // RU tab kontrolü
                if (!$('#ru input[name="name_ru"]').val()) {
                    errorMessage += 'Rus dilində məlumatları daxil edin<br>';
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
                            text: 'Kateqoriya müvəffəqiyyətlə əlavə edildi',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "{{ route('admin.category.index') }}";
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
