@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Başlık -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Məhsul Detalları</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Məhsullar</a></li>
                            <li class="breadcrumb-item active">Detal</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Üst Bölüm - Resim, Video ve İstatistikler -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Resim -->
                            <div class="col-md-4">
                                <div class="position-relative rounded overflow-hidden" style="height: 300px;">
                                    <img src="{{ asset($product->thumbnail) }}" 
                                         class="w-100 h-100 object-fit-cover" 
                                         alt="{{ $product->name_az }}">
                                </div>
                            </div>
                            
                            <!-- Önizleme Videosu -->
                            <div class="col-md-4">
                                <div class="position-relative rounded overflow-hidden" style="height: 300px;">
                                    <video id="previewVideo" class="w-100 h-100 object-fit-cover" controls>
                                        <source src="{{ asset($product->preview_video) }}" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <!-- İstatistikler -->
                            <div class="col-md-4">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Məhsul Statistikaları</h5>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-primary-subtle text-primary rounded">
                                                        <i class="fas fa-video fs-3"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Ümumi Video</h6>
                                                <p class="text-muted mb-0">{{ $product->videos->count() }} video</p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-warning-subtle text-warning rounded">
                                                        <i class="fas fa-clock fs-3"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Ümumi Müddət</h6>
                                                <p class="text-muted mb-0">{{ gmdate("H:i:s", $product->videos->sum('duration')) }}</p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-success-subtle text-success rounded">
                                                        <i class="fas fa-download fs-3"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Ümumi Yükləmə</h6>
                                                <p class="text-muted mb-0">{{ $product->videos->sum('download_count') }} dəfə</p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-info-subtle text-info rounded">
                                                        <i class="fas fa-star fs-3"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Ortalama Reytinq</h6>
                                                <p class="text-muted mb-0">
                                                    {{ number_format($product->videos->avg('rating'), 1) }}
                                                    <span class="text-warning ms-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= round($product->videos->avg('rating')) ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Videolar Tablosu -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-center" style="width: 50px">#</th>
                                                <th>Video Adı</th>
                                                <th class="text-center" style="width: 120px">Müddət</th>
                                                <th class="text-center" style="width: 100px">Baxış</th>
                                                <th class="text-center" style="width: 100px">Yükləmə</th>
                                                <th class="text-center" style="width: 150px">Reytinq</th>
                                                <th class="text-center" style="width: 150px">Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product->videos as $video)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $video->title }}</td>
                                                <td class="text-center">{{ gmdate("i:s", $video->duration) }}</td>
                                                <td class="text-center">{{ $video->view_count }}</td>
                                                <td class="text-center">{{ $video->download_count }}</td>
                                                <td class="text-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $video->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" 
                                                            class="btn btn-primary btn-sm" 
                                                            onclick="playVideo('{{ asset($video->video_path) }}', {{ $video->id }})">
                                                        <i class="fas fa-play me-1"></i> Oynat
                                                    </button>
                                                    <a href="{{ route('admin.product.video.download', $video->id) }}" 
                                                       class="btn btn-success btn-sm">
                                                        <i class="fas fa-download me-1"></i> Yüklə
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

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Oynatıcı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <video id="videoPlayer" class="w-100" controls>
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function playVideo(videoUrl, videoId) {
    const player = document.getElementById('videoPlayer');
    player.src = videoUrl;
    player.load();
    
    const modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal.show();
    
    // İzlenme sayısını artır
    $.post('{{ route("admin.product.video.increment-view") }}', {
        _token: '{{ csrf_token() }}',
        video_id: videoId
    });
}

// Modal kapandığında videoyu durdur
document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
    const player = document.getElementById('videoPlayer');
    player.pause();
    player.currentTime = 0;
});
</script>
@endpush

@push('css')
<style>
.object-fit-cover {
    object-fit: cover;
}

.avatar-sm {
    height: 3rem;
    width: 3rem;
}

.avatar-title {
    align-items: center;
    display: flex;
    height: 100%;
    justify-content: center;
    width: 100%;
}

.bg-primary-subtle { background-color: rgba(85, 110, 230, 0.1); }
.bg-warning-subtle { background-color: rgba(255, 199, 0, 0.1); }
.bg-success-subtle { background-color: rgba(10, 179, 156, 0.1); }
.bg-info-subtle { background-color: rgba(41, 156, 219, 0.1); }
</style>
@endpush