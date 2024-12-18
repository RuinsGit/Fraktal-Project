@extends('back.layouts.master')
@section('title', 'Təhsil Məzmunu')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Təhsil Məzmunu</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Təhsil Məzmunu</li>
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
                                <a href="{{ route('admin.study-content.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Şəkil</th>
                                            <th>Mətn (AZ)</th>
                                            <th>Təsvir (AZ)</th>
                                            <th>Status</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($studyContents as $content)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/study-content/' . $content->image) }}" 
                                                         alt="Content Image" 
                                                         class="rounded avatar-sm">
                                                </td>
                                                <td>{{ Str::limit($content->text_az, 50) }}</td>
                                                <td>{!! Str::limit(strip_tags($content->description_az), 50) !!}</td>
                                                <td>
                                                    <div class="form-check form-switch form-switch-lg">
                                                        <input class="form-check-input" 
                                                               type="checkbox"
                                                               onchange="changeStatus({{ $content->id }})"
                                                               {{ $content->status ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.study-content.edit', $content->id) }}" 
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
                    axios.delete(`{{ route('admin.study-content.destroy', '') }}/${id}`)
                        .then(function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Uğurlu!',
                                text: response.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch(function (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Xəta!',
                                text: 'Xəta baş verdi',
                            });
                        });
                }
            });
        }

        function changeStatus(id) {
            axios.get(`{{ route('admin.study-content.status', '') }}/${id}`)
                .then(function (response) {
                    if (response.data.status === 'success') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta!',
                        text: 'Xəta baş verdi',
                    });
                });
        }
    </script>
@endpush