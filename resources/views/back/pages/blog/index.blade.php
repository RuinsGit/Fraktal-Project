@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Bloglar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Bloglar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-soft-primary">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">Blog Siyahısı</h5>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary waves-effect waves-light">
                                        <i class="fas fa-plus me-2"></i>Yeni Blog
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-check-all me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Şəkil</th>
                                            <th>Başlıq</th>
                                            <th>Blog Növü</th>
                                            <th>Status</th>
                                            <th>Baxış sayı</th>
                                            <th>Tarix</th>
                                            <th>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blogs as $blog)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset($blog->image) }}" 
                                                         alt="Blog Image"
                                                         class="rounded"
                                                         width="50" height="50"
                                                         style="object-fit: cover;">
                                                </td>
                                                <td>{{ $blog->title_az }}</td>
                                                <td>
                                                    @if($blog->blogType)
                                                        <span class="badge bg-info">{{ $blog->blogType->name }}</span>
                                                    @else
                                                        <span class="badge bg-warning">Təyin edilməyib</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($blog->status == 1)
                                                        <span class="badge bg-success">Aktiv</span>
                                                    @else
                                                        <span class="badge bg-danger">Deaktiv</span>
                                                    @endif
                                                </td>
                                                <td>{{ $blog->view_count }}</td>
                                                <td>{{ \Carbon\Carbon::parse($blog->published_at)->format('d.m.Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" 
                                                       onclick="deleteItem({{ $blog->id }})"
                                                       class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
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
    <script src="{{ asset('back/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // DataTable initialization
            $('.table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Turkish.json'
                }
            });

            // Silme işlemi için SweetAlert2
            window.deleteItem = function(id) {
                Swal.fire({
                    title: 'Silmək istədiyinizdən əminsiniz?',
                    text: "Bu əməliyyat geri alına bilməz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Bəli, sil!',
                    cancelButtonText: 'Xeyr',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `{{ route('admin.blog.destroy', '') }}/${id}`;
                    }
                });
            }

            // Alert'leri otomatik kapat
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        });
    </script>
@endpush
