@extends('back.layouts.master')
@section('title', 'Vizyonumuz')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Vizyonumuz</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Vizyonumuz</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="d-flex justify-content-end mb-4">
                                    @if(!isset($vision))
                                        <a href="{{ route('admin.about.vision.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Yeni
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @if(isset($vision))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Şəkil</th>
                                                <th>İkon 1</th>
                                                <th>Ad 1</th>
                                                <th>İkon 2</th>
                                                <th>Ad 2</th>
                                                <th>Status</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($vision->image) }}" alt="image" width="100">
                                                </td>
                                                <td>
                                                    <img src="{{ asset($vision->icon_1) }}" alt="icon_1" width="100">
                                                </td>
                                                <td>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#name1_az" role="tab">AZ</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#name1_en" role="tab">EN</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#name1_ru" role="tab">RU</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content p-3">
                                                        <div class="tab-pane active" id="name1_az" role="tabpanel">
                                                            {{ $vision->name_1_az }}
                                                        </div>
                                                        <div class="tab-pane" id="name1_en" role="tabpanel">
                                                            {{ $vision->name_1_en }}
                                                        </div>
                                                        <div class="tab-pane" id="name1_ru" role="tabpanel">
                                                            {{ $vision->name_1_ru }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{ asset($vision->icon_2) }}" alt="icon_2" width="100">
                                                </td>
                                                <td>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#name2_az" role="tab">AZ</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#name2_en" role="tab">EN</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#name2_ru" role="tab">RU</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content p-3">
                                                        <div class="tab-pane active" id="name2_az" role="tabpanel">
                                                            {{ $vision->name_2_az }}
                                                        </div>
                                                        <div class="tab-pane" id="name2_en" role="tabpanel">
                                                            {{ $vision->name_2_en }}
                                                        </div>
                                                        <div class="tab-pane" id="name2_ru" role="tabpanel">
                                                            {{ $vision->name_2_ru }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" 
                                                        onclick="changeStatus({{ $vision->id }})"
                                                        class="btn btn-{{ $vision->status == 1 ? 'success' : 'danger' }} btn-sm">
                                                        {{ $vision->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.about.vision.edit', $vision->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                        onclick="deleteData({{ $vision->id }})"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    Məlumat tapılmadı
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.about.vision.status', '') }}/${id}`,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success') {
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
                    window.location.href = `{{ route('admin.about.vision.destroy', '') }}/${id}`;
                }
            });
        }
    </script>
@endpush