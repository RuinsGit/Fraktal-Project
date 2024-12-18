@extends('back.layouts.master')

@section('title', 'Tarixlərimiz')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tarixlərimiz</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item active">Tarixlərimiz</li>
                            </ol>
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('admin.history.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Yeni
                        </a>
                    </div>
                </div>
            </div>

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
                                        <table class="table table-responsive mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>İl</th>
                                                    <th>Mətn</th>
                                                    <th>Status</th>
                                                    <th>Yaranma tarixi</th>
                                                    <th>Əməliyyatlar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($histories as $history)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $history->number }}</td>
                                                        <td>{!! $history->text_az !!}</td>
                                                        <td>
                                                            <button class="btn btn-{{ $history->status == 1 ? 'success' : 'danger' }} btn-sm" 
                                                                    onclick="changeStatus({{ $history->id }})">
                                                                {{ $history->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                            </button>
                                                        </td>
                                                        <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.history.edit', $history->id) }}" 
                                                               class="btn btn-success btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $history->id }})">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-responsive mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Year</th>
                                                    <th>Text</th>
                                                    <th>Status</th>
                                                    <th>Created at</th>
                                                    <th>Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($histories as $history)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $history->number }}</td>
                                                        <td>{!! $history->text_en !!}</td>
                                                        <td>
                                                            <button class="btn btn-{{ $history->status == 1 ? 'success' : 'danger' }} btn-sm" 
                                                                    onclick="changeStatus({{ $history->id }})">
                                                                {{ $history->status == 1 ? 'Active' : 'Inactive' }}
                                                            </button>
                                                        </td>
                                                        <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.history.edit', $history->id) }}" 
                                                               class="btn btn-success btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $history->id }})">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-responsive mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Год</th>
                                                    <th>Текст</th>
                                                    <th>Статус</th>
                                                    <th>Дата создания</th>
                                                    <th>Операции</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($histories as $history)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $history->number }}</td>
                                                        <td>{!! $history->text_ru !!}</td>
                                                        <td>
                                                            <button class="btn btn-{{ $history->status == 1 ? 'success' : 'danger' }} btn-sm" 
                                                                    onclick="changeStatus({{ $history->id }})">
                                                                {{ $history->status == 1 ? 'Активный' : 'Неактивный' }}
                                                            </button>
                                                        </td>
                                                        <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.history.edit', $history->id) }}" 
                                                               class="btn btn-success btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" 
                                                                    onclick="deleteItem({{ $history->id }})">
                                                                <i class="mdi mdi-delete"></i>
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
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteItem(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Silmək istədiyinizdən əminsiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli!',
                cancelButtonText: 'Xeyr!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('admin.history.destroy', '') }}/${id}`;
                }
            })
        }

        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.history.status', '') }}/${id}`,
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
    </script>
@endpush