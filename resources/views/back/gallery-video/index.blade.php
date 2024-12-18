@extends('back.layouts.master')
@section('title', 'Qalereya Videoları')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Qalereya Videoları</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Qalereya Videoları</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 d-flex justify-content-end mb-4">
                                <a href="{{ route('admin.gallery-video.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified mb-3" role="tablist">
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

                            <div class="tab-content">
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ad (AZ)</th>
                                                    <th>Video</th>
                                                    <th>Status</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($galleryVideos as $video)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $video->name_az }}</td>
                                                        <td>
                                                            <video width="200" controls>
                                                                <source src="{{ asset('uploads/gallery-videos/' . $video->video) }}" type="video/mp4">
                                                                Brauzeriniz video təğini dəstəkləmir.
                                                            </video>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch form-switch-lg">
                                                                <input class="form-check-input" 
                                                                       type="checkbox"
                                                                       onchange="changeStatus({{ $video->id }})"
                                                                       {{ $video->status ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.gallery-video.edit', $video->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $video->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- EN Tab -->
                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name (EN)</th>
                                                    <th>Video</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($galleryVideos as $video)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $video->name_en }}</td>
                                                        <td>
                                                            <video width="200" controls>
                                                                <source src="{{ asset('uploads/gallery-videos/' . $video->video) }}" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch form-switch-lg">
                                                                <input class="form-check-input" 
                                                                       type="checkbox"
                                                                       onchange="changeStatus({{ $video->id }})"
                                                                       {{ $video->status ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.gallery-video.edit', $video->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $video->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- RU Tab -->
                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Имя (RU)</th>
                                                    <th>Видео</th>
                                                    <th>Статус</th>
                                                    <th>Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($galleryVideos as $video)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $video->name_ru }}</td>
                                                        <td>
                                                            <video width="200" controls>
                                                                <source src="{{ asset('uploads/gallery-videos/' . $video->video) }}" type="video/mp4">
                                                                Ваш браузер не поддерживает тег video.
                                                            </video>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch form-switch-lg">
                                                                <input class="form-check-input" 
                                                                       type="checkbox"
                                                                       onchange="changeStatus({{ $video->id }})"
                                                                       {{ $video->status ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.gallery-video.edit', $video->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $video->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'Silmək istədiyinizdən əminsiniz?',
                text: "Bu əməliyyat geri alına bilməz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('admin.gallery-video.destroy', '') }}/${id}`;
                }
            });
        }

        function changeStatus(id) {
            fetch(`{{ route('admin.gallery-video.status', '') }}/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
        }
    </script>
@endpush 