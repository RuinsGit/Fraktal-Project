@extends('back.layouts.master')
@section('title', 'Psixologiya Mətnləri')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Psixologiya Mətnləri</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Psixologiya Mətnləri</li>
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
                                    <a href="{{ route('admin.psychology-text.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                </div>
                            </div>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ad</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($psychologyTexts as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name_az }}</td>
                                            <td>
                                                <button type="button" 
                                                    onclick="changeStatus({{ $item->id }})" 
                                                    title="Status dəyiş"
                                                    class="btn btn-{{ $item->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $item->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.psychology-text.edit', $item->id) }}" 
                                                   class="btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger" 
                                                        onclick="deleteData({{ $item->id }})">
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.psychology-text.status', '') }}/${id}`,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success') {
                        window.location.reload();
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
                    $.ajax({
                        url: `/admin/psychology-text/destroy/${id}`,
                        type: 'GET',
                        success: function(response) {
                            if(response.status === 'success') {
                                Swal.fire(
                                    'Silindi!',
                                    'Məlumat uğurla silindi.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Xəta!',
                                    response.message || 'Silmə zamanı xəta baş verdi.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr);
                            Swal.fire(
                                'Xəta!',
                                'Silmə zamanı xəta baş verdi.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush