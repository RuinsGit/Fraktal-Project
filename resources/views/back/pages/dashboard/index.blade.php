@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Başlık -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                </div>
            </div>
        </div>

        <!-- İstatistik Kartları -->
        <div class="row">
            <!-- Toplam Satış -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-0">Ümumi Satış</p>
                                <h4 class="fs-22 fw-semibold mb-0">₼{{ number_format($totalSales ?? 0, 2) }}</h4>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="badge bg-light text-success mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i> {{ $salesGrowth ?? 0 }}%
                                    </span> Ötən aya görə
                                </p>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-success rounded fs-3">
                                    <i class="ri-shopping-cart-2-line text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toplam Sipariş -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-0">Ümumi Sifariş</p>
                                <h4 class="fs-22 fw-semibold mb-0">{{ $totalOrders ?? 0 }}</h4>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="badge bg-light text-success mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i> {{ $orderGrowth ?? 0 }}%
                                    </span> Ötən aya görə
                                </p>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded fs-3">
                                    <i class="ri-file-list-3-line text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toplam Ürün -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-0">Ümumi Məhsul</p>
                                <h4 class="fs-22 fw-semibold mb-0">{{ $totalProducts ?? 0 }}</h4>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="badge bg-light text-info mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i> {{ $productGrowth ?? 0 }}%
                                    </span> Ötən aya görə
                                </p>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                    <i class="ri-shopping-bag-line text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toplam Müşteri -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-0">Ümumi Müştəri</p>
                                <h4 class="fs-22 fw-semibold mb-0">{{ $totalCustomers ?? 0 }}</h4>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="badge bg-light text-danger mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i> {{ $customerGrowth ?? 0 }}%
                                    </span> Ötən aya görə
                                </p>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                    <i class="ri-user-3-line text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik ve Tablolar -->
        <div class="row">
            <!-- Satış Grafiği -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Aylıq Satış Statistikası</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Son Siparişler -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Son Sifarişlər</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Sifariş ID</th>
                                        <th scope="col">Müştəri</th>
                                        <th scope="col">Məbləğ</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders ?? [] as $order)
                                    <tr>
                                        <td>{{ $order->code }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>₼{{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status_badge }}">
                                                {{ $order->status_text }}
                                            </span>
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
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Satış grafiği
    var ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels ?? []) !!},
            datasets: [{
                label: 'Aylıq Satış',
                data: {!! json_encode($chartData ?? []) !!},
                borderColor: '#0ab39c',
                backgroundColor: 'rgba(10, 179, 156, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₼' + value;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush 