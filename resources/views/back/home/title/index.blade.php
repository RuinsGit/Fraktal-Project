@extends('back.layouts.master')
@section('title', 'Ana Səhifə Başlıqlar')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ana Səhifə Başlıqlar</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Başlıqlar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if($titles->count() < 1)
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="{{route('admin.home.title.create')}}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                </div>
                            @endif

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Şəkil</th>
                                    <th>Göstərdiyimiz xidmətlər</th>
                                    <th>Təklif etdiyimiz kurslar</th>
                                    <th>Müştərilərimiz nə deyir?</th>
                                    <th>Üstünlüklərimiz</th>
                                    <th>Bloqlar və yeniliklər</th>
                                    <th>Tariximiz</th>
                                    <th>Status</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($titles as $title)
                                    <tr>
                                        <td>{{$title->id}}</td>
                                        <td>
                                            <img src="{{asset($title->image)}}" alt="" style="width: 100px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td>
                                            AZ: {{$title->name_1_az ?? '-'}}<br>
                                            EN: {{$title->name_1_en ?? '-'}}<br>
                                            RU: {{$title->name_1_ru ?? '-'}}
                                        </td>
                                        <td>
                                            AZ: {{$title->name_2_az ?? '-'}}<br>
                                            EN: {{$title->name_2_en ?? '-'}}<br>
                                            RU: {{$title->name_2_ru ?? '-'}}
                                        </td>
                                        <td>
                                            AZ: {{$title->name_3_az ?? '-'}}<br>
                                            EN: {{$title->name_3_en ?? '-'}}<br>
                                            RU: {{$title->name_3_ru ?? '-'}}
                                        </td>
                                        <td>
                                            AZ: {{$title->name_4_az ?? '-'}}<br>
                                            EN: {{$title->name_4_en ?? '-'}}<br>
                                            RU: {{$title->name_4_ru ?? '-'}}
                                        </td>
                                        <td>
                                            AZ: {{$title->name_5_az ?? '-'}}<br>
                                            EN: {{$title->name_5_en ?? '-'}}<br>
                                            RU: {{$title->name_5_ru ?? '-'}}
                                        </td>
                                        <td>
                                            AZ: {{$title->name_6_az ?? '-'}}<br>
                                            EN: {{$title->name_6_en ?? '-'}}<br>
                                            RU: {{$title->name_6_ru ?? '-'}}
                                        </td>
                                        <td>
                                            <button type="button" 
                                                    data-id="{{$title->id}}" 
                                                    class="btn btn-sm btn-outline-{{ $title->status == 1 ? 'success' : 'danger' }} waves-effect waves-light status-button">
                                                {{ $title->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.home.title.edit', $title->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($titles->count() > 1)
                                                <button type="button" class="btn btn-danger" onclick="deleteButton({{$title->id}})">
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
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "info": false,
                "searching": false,
                "lengthChange": false,
                "columnDefs": [
                    { "orderable": false, "targets": [1, 8, 9] }
                ]
            });
        });

        function deleteButton(id) {
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
                    window.location.href = `{{ route('admin.home.title.destroy', '') }}/${id}`;
                }
            });
        }

        $('.status-button').click(function () {
            let id = $(this).data('id');
            $.ajax({
                url: `{{ route('admin.home.title.status', '') }}/${id}`,
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });
        });
    </script>

    @if(session('success'))
        <script>
            toastr.success('{{ session('success') }}');
        </script>
    @endif
@endpush

@push('css')
    <link href="{{ asset('back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush