@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Alt kateqoriya</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Alt kateqoriya</li>
                            </ol>
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('admin.sub-category.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
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

                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Ad (Az)</th>
                                                    <th>Kateqoriya</th>
                                                    <th>Yaranma tarixi</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sub_categories as $sub_category)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset($sub_category->image) }}" width="70" height="70" alt="">
                                                        </td>
                                                        <td>{{ $sub_category->name_az }}</td>
                                                        <td>{{ $sub_category->category->name_az }}</td>
                                                        <td>{{ $sub_category->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.sub-category.edit', $sub_category->id) }}" class="btn btn-success">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <button class="btn btn-danger" onclick="deleteItem({{ $sub_category->id }})">
                                                                <i class="mdi mdi-delete"></i>
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
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Ad (En)</th>
                                                    <th>Kateqoriya</th>
                                                    <th>Yaranma tarixi</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sub_categories as $sub_category)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset($sub_category->image) }}" width="70" height="70" alt="">
                                                        </td>
                                                        <td>{{ $sub_category->name_en }}</td>
                                                        <td>{{ $sub_category->category->name_en }}</td>
                                                        <td>{{ $sub_category->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.sub-category.edit', $sub_category->id) }}" class="btn btn-success">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <button class="btn btn-danger" onclick="deleteItem({{ $sub_category->id }})">
                                                                <i class="mdi mdi-delete"></i>
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
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Ad (Ru)</th>
                                                    <th>Kateqoriya</th>
                                                    <th>Yaranma tarixi</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sub_categories as $sub_category)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset($sub_category->image) }}" width="70" height="70" alt="">
                                                        </td>
                                                        <td>{{ $sub_category->name_ru }}</td>
                                                        <td>{{ $sub_category->category->name_ru }}</td>
                                                        <td>{{ $sub_category->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.sub-category.edit', $sub_category->id) }}" class="btn btn-success">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <button class="btn btn-danger" onclick="deleteItem({{ $sub_category->id }})">
                                                                <i class="mdi mdi-delete"></i>
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
                    fetch(`/admin/sub-category/${id}/delete`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Silindi!',
                                text: data.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Xəta!',
                                text: data.message,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush