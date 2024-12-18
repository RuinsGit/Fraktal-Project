@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Blog Düzənlə</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Bloglar</a></li>
                                <li class="breadcrumb-item active">Düzənlə</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            @foreach(\App\Models\Blog::getStatusList() as $key => $value)
                                                <option value="{{ $key }}" {{ $blog->status == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Şəkil</label>
                                        <input type="file" 
                                               name="image" 
                                               class="form-control @error('image') is-invalid @enderror"
                                               accept="image/*">
                                        @if($blog->image)
                                            <div class="mt-2">
                                                <img src="{{ asset($blog->image) }}" 
                                                     alt="Blog Image"
                                                     class="img-thumbnail"
                                                     style="height: 100px;">
                                            </div>
                                        @endif
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Blog Növü</label>
                                        <select name="blog_type_id" class="form-select @error('blog_type_id') is-invalid @enderror">
                                            <option value="">Blog növü seçin</option>
                                            @foreach($blogTypes as $type)
                                                <option value="{{ $type->id }}" {{ $blog->blog_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('blog_type_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                            <span>AZ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                            <span>EN</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                            <span>RU</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    @foreach(['az', 'en', 'ru'] as $lang)
                                        <div class="tab-pane {{ $lang === 'az' ? 'active' : '' }}" 
                                             id="{{ $lang }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Başlıq ({{ strtoupper($lang) }})</label>
                                                    <input type="text" 
                                                           name="title_{{ $lang }}"
                                                           value="{{ old('title_' . $lang, $blog->{'title_' . $lang}) }}"
                                                           class="form-control @error('title_' . $lang) is-invalid @enderror">
                                                    @error('title_' . $lang)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Mətn ({{ strtoupper($lang) }})</label>
                                                    <textarea name="description_{{ $lang }}"
                                                              class="form-control summernote @error('description_' . $lang) is-invalid @enderror"
                                                              rows="5">{{ old('description_' . $lang, $blog->{'description_' . $lang}) }}</textarea>
                                                    @error('description_' . $lang)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
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

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Summernote editörü
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Form değişiklik kontrolü
            let formChanged = false;
            
            // Başlangıçtaki form verilerini kaydet
            const $form = $('form');
            const initialFormData = new FormData($form[0]);
            
            // Form elemanlarının değişikliklerini izle (resim hariç)
            $('form :input:not([type="file"])').on('change input', function() {
                checkFormChanges();
            });

            // Summernote değişikliklerini izle
            $('.summernote').on('summernote.change', function() {
                formChanged = true;
            });

            // Form değişikliklerini kontrol et
            function checkFormChanges() {
                const currentFormData = new FormData($form[0]);
                formChanged = false;

                // FormData objelerini karşılaştır (resim hariç)
                for (let pair of currentFormData.entries()) {
                    if (pair[0] !== 'image' && pair[1] !== initialFormData.get(pair[0])) {
                        formChanged = true;
                        break;
                    }
                }
            }

            // Form submit işlemi
            $form.on('submit', function(e) {
                e.preventDefault();

                // Eğer form değişmemişse direkt index sayfasına yönlendir
                if (!formChanged && !$('input[type="file"]')[0].files.length) {
                    window.location.href = "{{ route('admin.blog.index') }}";
                    return;
                }

                // Form değişmişse normal submit işlemi yap
                this.submit();
            });
        });
    </script>
@endpush
