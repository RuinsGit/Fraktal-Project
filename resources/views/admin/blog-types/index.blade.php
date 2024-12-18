@extends('back.layouts.master')

@section('title', 'Blog Növləri')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Blog Növləri</h4>
                            <a href="{{ route('admin.blog-types.create') }}" class="btn btn-primary waves-effect waves-light">
                                <i class="ri-add-line align-middle me-1"></i> Yeni Əlavə Et
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad (AZ)</th>
                                        <th>Ad (EN)</th>
                                        <th>Ad (RU)</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogTypes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name_az }}</td>
                                        <td>{{ $item->name_en }}</td>
                                        <td>{{ $item->name_ru }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                                {{ $item->status ? 'Aktiv' : 'Deaktiv' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.blog-types.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $item->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.blog-types.destroy', $item->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });

    function deleteData(id) {
        Swal.fire({
            title: 'Əminsinizmi?',
            text: "Bu əməliyyatı geri ala bilməzsiniz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Bəli, sil!',
            cancelButtonText: 'Xeyr'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush 