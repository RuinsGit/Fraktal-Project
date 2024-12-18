@extends('back.layouts.master')
@section('title', 'Fraktals MMC')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Fraktals MMC</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Fraktals MMC</li>
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
                                    @if(!isset($aboutCompany))
                                        <a href="{{ route('admin.about.company.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Yeni
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @if(isset($aboutCompany))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Şəkil</th>
                                                <th>Ad</th>
                                                <th>Mətn</th>
                                                <th>Status</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($aboutCompany->image) }}" alt="image" width="100">
                                                </td>
                                                <td>{{ $aboutCompany->name_az }}</td>
                                                <td>{{ Str::limit($aboutCompany->description_az, 100) }}</td>
                                                <td>
                                                    <button type="button" 
                                                        onclick="changeStatus({{ $aboutCompany->id }})"
                                                        class="btn btn-{{ $aboutCompany->status == 1 ? 'success' : 'danger' }} btn-sm">
                                                        {{ $aboutCompany->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.about.company.edit', $aboutCompany->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                        onclick="deleteData({{ $aboutCompany->id }})"
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
                url: `{{ route('admin.about.company.status', '') }}/${id}`,
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
                    window.location.href = `{{ route('admin.about.company.destroy', '') }}/${id}`;
                }
            });
        }
    </script>
@endpush