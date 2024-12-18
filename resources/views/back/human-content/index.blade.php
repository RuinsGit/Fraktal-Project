@extends('back.layouts.master')
@section('title', 'İnsan Məzmunu')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">İnsan Məzmunu</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">İnsan Məzmunu</li>
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
                                <a href="{{ route('admin.human-content.create') }}" class="btn btn-primary">
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
                                                    <th>Şəkil</th>
                                                    <th>Ad (AZ)</th>
                                                    <th>Təsvir (AZ)</th>
                                                    <th>Status</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($humanContents as $content)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset('uploads/human-content/' . $content->image) }}" 
                                                                 alt="Content Image" 
                                                                 class="rounded avatar-sm">
                                                        </td>
                                                        <td>{{ $content->name_az }}</td>
                                                        <td>{!! Str::limit($content->description_az, 50) !!}</td>
                                                        <td>
                                                            <div class="form-check form-switch form-switch-lg">
                                                                <input class="form-check-input" 
                                                                       type="checkbox"
                                                                       onchange="changeStatus({{ $content->id }})"
                                                                       {{ $content->status ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.human-content.edit', $content->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $content->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Name (EN)</th>
                                                    <th>Description (EN)</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($humanContents as $content)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset('uploads/human-content/' . $content->image) }}" 
                                                                 alt="Content Image" 
                                                                 class="rounded avatar-sm">
                                                        </td>
                                                        <td>{{ $content->name_en }}</td>
                                                        <td>{!! Str::limit($content->description_en, 50) !!}</td>
                                                        <td>
                                                            <div class="form-check form-switch form-switch-lg">
                                                                <input class="form-check-input" 
                                                                       type="checkbox"
                                                                       onchange="changeStatus({{ $content->id }})"
                                                                       {{ $content->status ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.human-content.edit', $content->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $content->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Изображение</th>
                                                    <th>Имя (RU)</th>
                                                    <th>Описание (RU)</th>
                                                    <th>Статус</th>
                                                    <th>Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($humanContents as $content)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset('uploads/human-content/' . $content->image) }}" 
                                                                 alt="Content Image" 
                                                                 class="rounded avatar-sm">
                                                        </td>
                                                        <td>{{ $content->name_ru }}</td>
                                                        <td>{!! Str::limit($content->description_ru, 50) !!}</td>
                                                        <td>
                                                            <div class="form-check form-switch form-switch-lg">
                                                                <input class="form-check-input" 
                                                                       type="checkbox"
                                                                       onchange="changeStatus({{ $content->id }})"
                                                                       {{ $content->status ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.human-content.edit', $content->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $content->id }})">
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
                    window.location.href = `{{ route('admin.human-content.destroy', '') }}/${id}`;
                }
            });
        }

        function changeStatus(id) {
            fetch(`{{ route('admin.human-content.status', '') }}/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
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