@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sifariş Detalları #{{ $order->code }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana səhifə</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Sifarişlər</a></li>
                            <li class="breadcrumb-item active">Sifariş #{{ $order->code }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h5 class="font-size-16 mb-3">Sifariş Məlumatları</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Sifariş №</th>
                                                    <td>{{ $order->code }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tarix</th>
                                                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        <span class="badge bg-{{ $order->status_badge }}">
                                                            {{ $order->status_text }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Ümumi məbləğ</th>
                                                    <td>{{ number_format($order->total_price, 2) }} ₼</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h5 class="font-size-16 mb-3">Müştəri Məlumatları</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Ad Soyad</th>
                                                    <td>{{ $order->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $order->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Telefon</th>
                                                    <td>{{ $order->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Ünvan</th>
                                                    <td>{{ $order->address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <h5 class="font-size-16 mb-3">Sifariş Edilən Məhsullar</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Məhsul ID</th>
                                                    <th>Məhsul</th>
                                                    <th>Məhsul Kodu</th>
                                                    <th>Qiymət</th>
                                                    <th>Miqdar</th>
                                                    <th>Cəmi</th>
                                                    <th>Əməliyyat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->order_products as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>#{{ $item->product_id }}</td>
                                                    <td>
                                                        @if($item->product)
                                                            {{ $item->product->title_az }}
                                                            <br>
                                                            <small class="text-muted">{{ $item->product_name }}</small>
                                                        @else
                                                            {{ $item->product_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->product)
                                                            <img src="{{ asset($item->product->thumbnail) }}" 
                                                                 alt="{{ $item->product->title_az }}" 
                                                                 class="img-thumbnail" 
                                                                 style="max-width: 50px;">
                                                        @else
                                                            <span class="text-muted">Məhsul silinib</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ number_format($item->product_price, 2) }} ₼</td>
                                                    <td>{{ $item->count }}</td>
                                                    <td>{{ number_format($item->product_price * $item->count, 2) }} ₼</td>
                                                    <td>
                                                        @if($item->product)
                                                            <a href="{{ route('admin.product.edit', $item->product_id) }}" 
                                                               class="btn btn-sm btn-info" 
                                                               target="_blank">
                                                                <i class="fas fa-eye"></i> Məhsula bax
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="6" class="text-end">
                                                        <strong>Ümumi məbləğ:</strong>
                                                    </td>
                                                    <td colspan="2">
                                                        <strong>{{ number_format($order->total_price, 2) }} ₼</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <h5 class="font-size-16 mb-3">Əlavə Məlumatlar</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Çatdırılma növü</th>
                                                    <td>{{ $order->delivery_type == 'delivery_address' ? 'Ünvana çatdırılma' : 'Mağazadan təhvil alma' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Ödəmə növü</th>
                                                    <td>{{ $order->payment_type == 'debet' ? 'Debet kart' : 'Bank köçürməsi' }}</td>
                                                </tr>
                                                @if($order->info)
                                                <tr>
                                                    <th>Qeyd</th>
                                                    <td>{{ $order->info }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Geri</a>
                                    @if($order->status != 3 && $order->status != 4)
                                    <button type="button" class="btn btn-success" onclick="changeStatus({{ $order->id }}, 3)">
                                        Təhvil verildi
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="changeStatus({{ $order->id }}, 4)">
                                        Ləğv et
                                    </button>
                                    @endif
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
<script>
function changeStatus(orderId, status) {
    Swal.fire({
        title: status == 3 ? 'Sifarişi təhvil vermək istədiyinizdən əminsiniz?' : 'Sifarişi ləğv etmək istədiyinizdən əminsiniz?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Bəli',
        cancelButtonText: 'Xeyr'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/order/${orderId}/change-status`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu!',
                            text: 'Status uğurla yeniləndi',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta!',
                        text: 'Status yenilənərkən xəta baş verdi'
                    });
                }
            });
        }
    });
}
</script>
@endpush
