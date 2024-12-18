@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Qalereya</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Qalereya</li>
                            </ol>
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">EN</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">RU</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Başlıq (Az)</th>
                                                    <th>Yaranma tarixi</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($galleries as $gallery)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @if($gallery->main_image)
                                                                <img src="{{ asset($gallery->main_image) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                                                            @endif
                                                            @if($gallery->sub_images)
                                                                <div class="mt-2">
                                                                    <small>Alt şəkillər: {{ count(json_decode($gallery->sub_images)) }} ədəd</small>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $gallery->title_az }}</td>
                                                        <td>{{ $gallery->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" 
                                                               class="btn btn-success">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <a class="btn btn-danger" onclick="deleteItem({{ $gallery->id }})">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- EN ve RU tabları için aynı tablo yapısı -->
                                <div class="tab-pane" id="en" role="tabpanel">
                                    <!-- EN içeriği -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Başlıq (En)</th>
                                                    <th>Yaranma tarixi</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($galleries as $gallery)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @if($gallery->main_image)
                                                                <img src="{{ asset($gallery->main_image) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                                                            @endif
                                                            @if($gallery->sub_images)
                                                                <div class="mt-2">
                                                                    <small>Alt şəkillər: {{ count(json_decode($gallery->sub_images)) }} ədəd</small>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $gallery->title_en }}</td>
                                                        <td>{{ $gallery->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" 
                                                               class="btn btn-success">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <a class="btn btn-danger" onclick="deleteItem({{ $gallery->id }})">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <!-- RU içeriği -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Şəkil</th>
                                                    <th>Başlıq (Ru)</th>
                                                    <th>Yaranma tarixi</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($galleries as $gallery)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @if($gallery->main_image)
                                                                <img src="{{ asset($gallery->main_image) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                                                            @endif
                                                            @if($gallery->sub_images)
                                                                <div class="mt-2">
                                                                    <small>Alt şəkillər: {{ count(json_decode($gallery->sub_images)) }} ədəd</small>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $gallery->title_ru }}</td>
                                                        <td>{{ $gallery->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" 
                                                               class="btn btn-success">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <a class="btn btn-danger" onclick="deleteItem({{ $gallery->id }})">
                                                                <i class="mdi mdi-delete"></i>
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
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteItem(id) {
            event.preventDefault();
            let url = "{{ route('admin.gallery.destroy', ':id') }}".replace(':id', id);
            
            Swal.fire({
                title: 'Silmək istədiyinizdən əminsiniz?',
                text: "Bu əməliyyatı geri ala bilməzsiniz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
@endpush