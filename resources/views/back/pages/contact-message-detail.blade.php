@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Müraciət Detalları</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.contact-message.index') }}">Əlaqə müraciətləri</a></li>
                                <li class="breadcrumb-item active">Detal</li>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Ad Soyad</label>
                                        <p class="form-control">{{ $message->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">E-mail</label>
                                        <p class="form-control">{{ $message->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Telefon</label>
                                        <p class="form-control">{{ $message->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <p class="form-control">{!! $message->status_badge !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tarix</label>
                                        <p class="form-control">{{ $message->created_at->format('d.m.Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Mesaj</label>
                                        <div class="form-control" style="min-height: 120px;">
                                            {!! nl2br(e($message->message)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="button-group">
                                        <a href="{{ route('admin.contact-message.index') }}" class="btn btn-primary">
                                            <i class="ri-arrow-left-line me-1"></i>Geri
                                        </a>

                                        @if(!$message->status)
                                            <form action="{{ route('admin.contact-message.mark-as-read', $message->id) }}" 
                                                  method="POST" 
                                                  class="d-inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="ri-check-line me-1"></i>Oxundu olaraq işarələ
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.contact-message.destroy', $message->id) }}" 
                                              method="POST" 
                                              class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="ri-delete-bin-line me-1"></i>Sil
                                            </button>
                                        </form>
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
        $(document).ready(function() {
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
@endpush