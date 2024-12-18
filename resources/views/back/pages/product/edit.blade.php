@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Məhsul Redaktə Et</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Məhsullar</a></li>
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
                        <form class="needs-validation" method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Dil Sekmeleri -->
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

                            <!-- Tab məzmunu -->
                            <div class="tab-content p-3">
                                <!-- AZ Tab -->
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="mb-3">
                                        <label>Ad (AZ)</label>
                                        <input type="text" name="name_az" class="form-control" value="{{ old('name_az', $product->name_az) }}">
                                        @error('name_az')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Başlıq (AZ)</label>
                                        <input type="text" name="title_az" class="form-control" value="{{ old('title_az', $product->title_az) }}">
                                        @error('title_az')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Təsvir (AZ)</label>
                                        <textarea name="description_az" class="form-control summernote">{{ old('description_az', $product->description_az) }}</textarea>
                                        @error('description_az')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- EN Tab -->
                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="mb-3">
                                        <label>Ad (EN)</label>
                                        <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $product->name_en) }}">
                                        @error('name_en')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Başlıq (EN)</label>
                                        <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $product->title_en) }}">
                                        @error('title_en')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Təsvir (EN)</label>
                                        <textarea name="description_en" class="form-control summernote">{{ old('description_en', $product->description_en) }}</textarea>
                                        @error('description_en')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- RU Tab -->
                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="mb-3">
                                        <label>Ad (RU)</label>
                                        <input type="text" name="name_ru" class="form-control" value="{{ old('name_ru', $product->name_ru) }}">
                                        @error('name_ru')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Başlıq (RU)</label>
                                        <input type="text" name="title_ru" class="form-control" value="{{ old('title_ru', $product->title_ru) }}">
                                        @error('title_ru')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Təsvir (RU)</label>
                                        <textarea name="description_ru" class="form-control summernote">{{ old('description_ru', $product->description_ru) }}</textarea>
                                        @error('description_ru')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Kategori seçimi - Alt kategori kaldırıldı -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Kateqoriya</label>
                                    <select name="category_id" class="form-select">
                                        <option value="">Seçin</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_az }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Qiymət və Endirim -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Qiymət</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               name="price" 
                                               step="0.01" 
                                               class="form-control" 
                                               value="{{ old('price', $product->price) }}"
                                               required>
                                        <span class="input-group-text">₼</span>
                                    </div>
                                    @error('price')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label>Endirim Faizi</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               name="discount_percentage" 
                                               class="form-control" 
                                               value="{{ old('discount_percentage', $product->discount_percentage) }}"
                                               min="0" 
                                               max="100">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @if($product->discount_percentage > 0)
                                        <small class="text-success">
                                            İndirimli qiymət: {{ number_format($product->discounted_price, 2) }} ₼
                                        </small>
                                    @endif
                                    @error('discount_percentage')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Mövcud Media -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Mövcud Şəkil</label>
                                        <div class="mb-2">
                                            @if($product->thumbnail && file_exists(public_path($product->thumbnail)))
                                                <img src="{{ asset($product->thumbnail) }}" alt="thumbnail" 
                                                     class="img-thumbnail" style="max-height: 150px">
                                            @else
                                                <p class="text-muted">Şəkil tapılmadı</p>
                                            @endif
                                        </div>
                                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                        @error('thumbnail')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Mövcud Önbaxış Videosu</label>
                                    <div class="mb-2">
                                        @if($product->preview_video)
                                            <video controls style="max-height: 150px">
                                                <source src="{{ asset($product->preview_video) }}" type="video/mp4">
                                            </video>
                                        @else
                                            <p class="text-muted">Video yoxdur</p>
                                        @endif
                                    </div>
                                    <input type="file" name="preview_video" class="form-control">
                                    @error('preview_video')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Videolar -->
                            <div class="mb-3">
                                <label>Videolar</label>
                                <input type="file" name="videos[]" class="form-control" multiple accept="video/*">
                                <small class="text-muted">Birdən çox video fayl seçə bilərsiniz</small>
                                @error('videos')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>

                            <!-- Mövcud Videolar -->
                            @if($product->videos->count() > 0)
                            <div class="mb-3">
                                <label>Mövcud Videolar</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Video</th>
                                                <th>Başlıq</th>
                                                <th>Müddət</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product->videos as $video)
                                            <tr>
                                                <td>
                                                    <video controls style="max-height: 100px">
                                                        <source src="{{ asset($video->video_path) }}" type="video/mp4">
                                                    </video>
                                                </td>
                                                <td>{{ $video->title }}</td>
                                                <td>{{ $video->duration }}</td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm"
                                                            onclick="deleteVideo({{ $video->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif

                            <!-- Status -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Aktiv</option>
                                        <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Deaktiv</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Sıralama</label>
                                    <input type="number" name="order" class="form-control" value="{{ old('order', $product->order) }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function deleteVideo(videoId) {
        if (confirm('Bu videoyu silmək istədiyinizdən əminsiniz?')) {
            // CSRF token'ı al
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Fetch API ile DELETE isteği gönder
            fetch(`/admin/product/video/${videoId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Başarılı ise sayfayı yenile
                    window.location.reload();
                } else {
                    alert('Video silinərkən xəta baş verdi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Video silinərkən xəta baş verdi');
            });
        }
    }

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.form-select').select2();
    });
</script>
@endpush

@push('css')
<link href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('back/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
