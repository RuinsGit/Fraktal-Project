@extends('back.layouts.master')

@section('title', 'Şirkətlər')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Şirkətlər</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Şirkətlər</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            @if($companies->count() < 1)
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('admin.home.company.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>
                            @endif

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
                                    <table id="datatable-az" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Şəkil</th>
                                                <th>Ad 1 (AZ)</th>
                                                <th>Ad 2 (AZ)</th>
                                                <th>Status</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($companies as $company)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset($company->image) }}" style="width: 100px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td>{{ $company->name_1_az }}</td>
                                                    <td>{{ $company->name_2_az }}</td>
                                                    <td>
                                                        <button class="btn btn-{{ $company->status ? 'success' : 'danger' }} btn-sm" onclick="statusChange({{ $company->id }})">
                                                            {{ $company->status ? 'Aktiv' : 'Deaktiv' }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.home.company.edit', $company->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        @if($companies->count() > 1)
                                                        <button class="btn btn-danger btn-sm" onclick="deleteCompany({{ $company->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="en" role="tabpanel">
                                    <table id="datatable-en" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name 1 (EN)</th>
                                                <th>Name 2 (EN)</th>
                                                <th>Status</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($companies as $company)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset($company->image) }}" style="width: 100px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td>{{ $company->name_1_en }}</td>
                                                    <td>{{ $company->name_2_en }}</td>
                                                    <td>
                                                        <button class="btn btn-{{ $company->status ? 'success' : 'danger' }} btn-sm" onclick="statusChange({{ $company->id }})">
                                                            {{ $company->status ? 'Active' : 'Inactive' }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.home.company.edit', $company->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        @if($companies->count() > 1)
                                                        <button class="btn btn-danger btn-sm" onclick="deleteCompany({{ $company->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <table id="datatable-ru" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Изображение</th>
                                                <th>Имя 1 (RU)</th>
                                                <th>Имя 2 (RU)</th>
                                                <th>Статус</th>
                                                <th>Операции</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($companies as $company)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset($company->image) }}" style="width: 100px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td>{{ $company->name_1_ru }}</td>
                                                    <td>{{ $company->name_2_ru }}</td>
                                                    <td>
                                                        <button class="btn btn-{{ $company->status ? 'success' : 'danger' }} btn-sm" onclick="statusChange({{ $company->id }})">
                                                            {{ $company->status ? 'Активный' : 'Неактивный' }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.home.company.edit', $company->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        @if($companies->count() > 1)
                                                        <button class="btn btn-danger btn-sm" onclick="deleteCompany({{ $company->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        @endif
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
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#datatable-az, #datatable-en, #datatable-ru').DataTable({
                "pageLength": 25,
                "responsive": true,
                "ordering": false,
                "info": false,
                "searching": false,
                "lengthChange": false
            });
        });

        function statusChange(id) {
            $.ajax({
                url: `{{ route('admin.home.company.status', '') }}/${id}`,
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Uğurlu!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tamam'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                }
            });
        }

        function deleteCompany(id) {
            Swal.fire({
                title: 'Əminsiniz?',
                text: "Bu əməliyyatı geri ala bilməzsiniz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('admin.home.company.destroy', '') }}/${id}`;
                }
            });
        }
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
@endpush

@push('css')
    <link href="{{ asset('back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush