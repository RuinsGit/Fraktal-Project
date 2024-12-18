@extends('back.layouts.master')
@section('title', 'Partnyor Redaktə')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Partnyor Redaktə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.home.partners.index') }}">Partnyor</a></li>
                                <li class="breadcrumb-item active">Redaktə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.home.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Mövcud Şəkil</label>
                                        <div>
                                            <img src="{{ asset('uploads/partners/' . $partner->image) }}" 
                                                 alt="Partner" 
                                                 width="100">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="image">Yeni Şəkil</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="link">Link</label>
                                        <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $partner->link) }}">
                                        @error('link')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                                        <a href="{{ route('admin.home.partners.index') }}" class="btn btn-secondary">Geri</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if($errors->any())
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Xəta!',
                html: `
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                `,
                showConfirmButton: true,
                confirmButtonText: 'Tamam'
            });
        </script>
    @endif
@endpush