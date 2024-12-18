@extends('back.layouts.master')
@section('title', 'Üstünlüklərimiz')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Üstünlüklərimiz</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Üstünlüklərimiz</li>
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
                                <h4 class="card-title">Üstünlüklərimiz</h4>
                                <a href="{{ route('admin.home.advantages.create') }}" class="btn btn-primary waves-effect waves-light">
                                    <i class="fas fa-plus"></i> Yeni
                                </a>
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

                            <table class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad (AZ)</th>
                                        <th>Mətn (AZ)</th>
                                        <th>Şəkil</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($advantages as $advantage)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $advantage->name_az }}</td>
                                            <td>{{ Str::limit($advantage->text_az, 50) }}</td>
                                            <td><img src="{{ asset($advantage->image) }}" alt="Image" width="50"></td>
                                            <td>
                                                <button type="button" 
                                                    onclick="changeStatus({{ $advantage->id }})"
                                                    class="btn btn-{{ $advantage->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $advantage->id }}">
                                                    {{ $advantage->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.home.advantages.edit', $advantage->id) }}" 
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                    onclick="deleteData({{ $advantage->id }})"
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

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.home.advantages.status', '') }}/${id}`,
                type: 'GET',
                success: function(response) {
                    if(response.success) {
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
                    window.location.href = `{{ route('admin.home.advantages.destroy', '') }}/${id}`;
                }
            });
        }
    </script>
@endpush