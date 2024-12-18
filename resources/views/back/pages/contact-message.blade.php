@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Əlaqə müraciətləri</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Əlaqə müraciətləri</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
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

                            <h4 class="card-title">Əlaqə müraciətləri</h4>
                            
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ad Soyad</th>
                                        <th>E-mail</th>
                                        <th>Telefon</th>
                                        <th>Status</th>
                                        <th>Tarix</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr>
                                            <td>{{ $message->id }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->phone }}</td>
                                            <td>{!! $message->status_badge !!}</td>
                                            <td>{{ $message->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.contact-message.show', $message->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                
                                                @if(!$message->status)
                                                    <form action="{{ route('admin.contact-message.mark-as-read', $message->id) }}" 
                                                          method="POST" 
                                                          class="d-inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="ri-check-line"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('admin.contact-message.destroy', $message->id) }}" 
                                                      method="POST" 
                                                      class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
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
@endsection

@push('css')
    <link href="{{ asset('back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"p>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    "emptyTable": "Cədvəldə heç bir məlumat yoxdur",
                    "info": "_TOTAL_ Nəticədən _START_ - _END_ Arası Nəticələr",
                    "infoEmpty": "Nəticə Yoxdur",
                    "infoFiltered": "(_MAX_ Nəticə İçindən Tapılan)",
                    "lengthMenu": "Səhifədə _MENU_ Nəticə Göstər",
                    "loadingRecords": "Yüklənir...",
                    "processing": "Gözləyin...",
                    "search": "Axtarış:",
                    "zeroRecords": "Nəticə Tapılmadı.",
                    "paginate": {
                        "first": "İlk",
                        "last": "Axırıncı",
                        "next": "Sonraki",
                        "previous": "Öncəki"
                    }
                },
                pageLength: 25
            });

            // Delete confirmation
            $('form').on('submit', function(e) {
                if ($(this).find('button[type="submit"]').hasClass('btn-danger')) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Əminsiniz?',
                        text: "Bu müraciəti silmək istədiyinizə əminsiniz?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Bəli, sil!',
                        cancelButtonText: 'Xeyr'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                }
            });
        });
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Uğurlu!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Xəta!',
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endpush