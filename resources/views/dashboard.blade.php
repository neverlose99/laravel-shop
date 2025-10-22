@extends('layouts.app')

@section('content')
<div style="padding-top: 120px;"></div>

<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title mb-4">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </h2>

        <!-- Welcome Banner -->
        <div class="alert alert-info mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-user-circle fa-3x me-3"></i>
                <div>
                    <h5 class="mb-1">Xin chào, {{ Auth::user()->name }}! </h5>
                    <p class="mb-0">Chào mừng bạn đến với tài khoản của mình. Quản lý đơn hàng và thông tin cá nhân tại đây.</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            @php
                $totalOrders = Auth::user()->orders()->count();
                $pendingOrders = Auth::user()->orders()->where('status', 'pending')->count();
                $completedOrders = Auth::user()->orders()->where('status', 'completed')->count();
                $cartItemsCount = \App\Helpers\CartHelper::getCartCount();
            @endphp

            <div class="col-md-3 col-sm-6">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-white-50 mb-2">Tổng đơn hàng</h6>
                                <h2 class="mb-0">{{ $totalOrders }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-shopping-bag fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card stat-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-white-50 mb-2">Đang xử lý</h6>
                                <h2 class="mb-0">{{ $pendingOrders }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-clock fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-white-50 mb-2">Hoàn thành</h6>
                                <h2 class="mb-0">{{ $completedOrders }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-check-circle fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card stat-card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-white-50 mb-2">Giỏ hàng</h6>
                                <h2 class="mb-0">{{ $cartItemsCount }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2"></i>Thao tác nhanh
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3 col-sm-6">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100 py-3">
                                    <i class="fas fa-shopping-bag d-block mb-2 fa-2x"></i>
                                    <span>Mua sắm</span>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-info w-100 py-3">
                                    <i class="fas fa-shopping-cart d-block mb-2 fa-2x"></i>
                                    <span>Giỏ hàng</span>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="{{ route('checkout.orders') }}" class="btn btn-outline-success w-100 py-3">
                                    <i class="fas fa-list d-block mb-2 fa-2x"></i>
                                    <span>Đơn hàng</span>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary w-100 py-3">
                                    <i class="fas fa-user-cog d-block mb-2 fa-2x"></i>
                                    <span>Cài đặt</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        @php
            $recentOrders = Auth::user()->orders()->latest()->take(5)->get();
        @endphp

        @if($recentOrders->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-history me-2"></i>Đơn hàng gần đây
                        </h5>
                        <a href="{{ route('checkout.orders') }}" class="btn btn-sm btn-primary">
                            Xem tất cả <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td><strong>{{ $order->order_number }}</strong></td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td><strong class="text-danger">${{ number_format($order->total_amount, 2) }}</strong></td>
                                        <td>{!! $order->status_badge !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('checkout.order.detail', $order->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Xem
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
        @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h5>Chưa có đơn hàng nào</h5>
                        <p class="text-muted">Hãy bắt đầu mua sắm ngay hôm nay!</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-shopping-bag me-2"></i>Khám phá sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>

<style>
.stat-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.stat-card h2 {
    font-size: 2.5rem;
    font-weight: bold;
}

.stat-card .card-title {
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-icon {
    opacity: 0.3;
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-radius: 8px;
}

.card-header {
    border-bottom: 1px solid #dee2e6;
}

.btn-outline-primary:hover,
.btn-outline-info:hover,
.btn-outline-success:hover,
.btn-outline-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.table td {
    vertical-align: middle;
}

.alert-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #222;
}
</style>
@endsection
