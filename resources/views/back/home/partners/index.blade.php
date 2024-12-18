@extends('back.layouts.master')
@section('title', 'Partnyor Siyahısı')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Partnyor Siyahısı</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Partnyor</li>
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
                                <h4 class="card-title">Partnyor Siyahısı</h4>
                                <a href="{{ route('admin.home.partners.create') }}" class="btn btn-primary waves-effect waves-light">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Şəkil</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($partners as $partner)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/partners/' . $partner->image) }}" 
                                                     alt="Partner" 
                                                     width="100">
                                            </td>
                                            <td>{{ $partner->link }}</td>
                                            <td>
                                                <button type="button" 
                                                    onclick="changeStatus({{ $partner->id }})"
                                                    class="btn btn-{{ $partner->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $partner->id }}">
                                                    {{ $partner->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.home.partners.edit', $partner->id) }}" 
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                    onclick="deleteData({{ $partner->id }})"
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
@endsection

@push('css')
    <link href="{{ asset('back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.home.partners.status', '') }}/${id}`,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success') {
                        let button = document.querySelector(`.status-button-${id}`);
                        if(response.newStatus) {
                            button.classList.remove('btn-danger');
                            button.classList.add('btn-success');
                            button.textContent = 'Aktiv';
                        } else {
                            button.classList.remove('btn-success');
                            button.classList.add('btn-danger');
                            button.textContent = 'Deaktiv';
                        }

                        Swal.fire({
                            title: 'Uğurlu!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tamam'
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
                    window.location.href = `{{ route('admin.home.partners.destroy', '') }}/${id}`;
                }
            });
        }
    </script>
@endpush