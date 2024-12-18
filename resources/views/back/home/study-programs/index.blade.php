@extends('back.layouts.master')
@section('title', 'Təhsil Proqramları')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Təhsil Proqramları</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Təhsil Proqramları</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title">Təhsil Proqramları</h4>
                                @if($programs->count() == 0)
                                    <a href="{{ route('admin.home.study-programs.create') }}" class="btn btn-primary waves-effect waves-light">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                @endif
                            </div>

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
                                                <table class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Şəkil</th>
                                                            <th>Ad</th>
                                                            <th>Mətn</th>
                                                            <th>Təsvir</th>
                                                            <th>Status</th>
                                                            <th>Əməliyyatlar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($programs as $program)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if($program->image)
                                                                        <img src="{{ asset($program->image) }}" alt="Program Image" style="max-width: 100px">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $program->name_az }}</td>
                                                                <td>{{ Str::limit($program->text_az, 50) }}</td>
                                                                <td>{{ Str::limit($program->description_az, 50) }}</td>
                                                                <td>
                                                                    <button type="button" 
                                                                        onclick="changeStatus({{ $program->id }})"
                                                                        class="btn btn-{{ $program->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $program->id }}">
                                                                        {{ $program->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.home.study-programs.edit', $program->id) }}" 
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" 
                                                                        onclick="deleteData({{ $program->id }})"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="en" role="tabpanel">
                                                <table class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Text</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($programs as $program)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if($program->image)
                                                                        <img src="{{ asset($program->image) }}" alt="Program Image" style="max-width: 100px">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $program->name_en }}</td>
                                                                <td>{{ Str::limit($program->text_en, 50) }}</td>
                                                                <td>{{ Str::limit($program->description_en, 50) }}</td>
                                                                <td>
                                                                    <button type="button" 
                                                                        onclick="changeStatus({{ $program->id }})"
                                                                        class="btn btn-{{ $program->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $program->id }}">
                                                                        {{ $program->status == 1 ? 'Active' : 'Inactive' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.home.study-programs.edit', $program->id) }}" 
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" 
                                                                        onclick="deleteData({{ $program->id }})"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="ru" role="tabpanel">
                                                <table class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Изображение</th>
                                                            <th>Имя</th>
                                                            <th>Текст</th>
                                                            <th>Описание</th>
                                                            <th>Статус</th>
                                                            <th>Действия</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($programs as $program)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if($program->image)
                                                                        <img src="{{ asset($program->image) }}" alt="Program Image" style="max-width: 100px">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $program->name_ru }}</td>
                                                                <td>{{ Str::limit($program->text_ru, 50) }}</td>
                                                                <td>{{ Str::limit($program->description_ru, 50) }}</td>
                                                                <td>
                                                                    <button type="button" 
                                                                        onclick="changeStatus({{ $program->id }})"
                                                                        class="btn btn-{{ $program->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $program->id }}">
                                                                        {{ $program->status == 1 ? 'Активный' : 'Неактивный' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.home.study-programs.edit', $program->id) }}" 
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" 
                                                                        onclick="deleteData({{ $program->id }})"
                                                                        class="btn btn-danger btn-sm">
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
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.home.study-programs.status', '') }}/${id}`,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success') {
                        let button = $(`.status-button-${id}`);
                        if(response.newStatus) {
                            button.removeClass('btn-danger').addClass('btn-success');
                            button.text('Aktiv');
                        } else {
                            button.removeClass('btn-success').addClass('btn-danger');
                            button.text('Deaktiv');
                        }

                        Swal.fire({
                            title: 'Uğurlu!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tamam'
                        });
                    } else {
                        Swal.fire({
                            title: 'Xəta!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Tamam'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Xəta!',
                        text: 'Əməliyyat zamanı xəta baş verdi',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Əminsiniz?',
                text: "Bu məlumatı silmək istədiyinizə əminsiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, Sil!',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('admin.home.study-programs.destroy', '') }}/${id}`;
                }
            });
        }
    </script>
@endpush