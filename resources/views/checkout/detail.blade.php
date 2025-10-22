@extends('layouts.app')

@section('content')
<div style="padding-top: 120px;"></div>

<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('checkout.orders') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="order-detail">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>Chi tiết đơn hàng: {{ $order->order_number }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Ngày đặt:</strong> 
                                        {{ $order->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                                    </p>
                                    <p class="mb-2 text-muted small">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $order->created_at->timezone('Asia/Ho_Chi_Minh')->diffForHumans() }}
                                    </p>
                                    <p class="mb-2">
                                        <strong>Trạng thái:</strong> 
                                        {!! $order->status_badge !!}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Thanh toán:</strong> 
                                        {!! $order->payment_status_badge !!}
                                    </p>
                                    <p class="mb-2">
                                        <strong>Phương thức:</strong>
                                        @switch($order->payment_method)
                                            @case('cod')
                                                Thanh toán khi nhận hàng
                                                @break
                                            @case('bank_transfer')
                                                Chuyển khoản ngân hàng
                                                @break
                                            @case('momo')
                                                Ví MoMo
                                                @break
                                            @case('vnpay')
                                                VNPay
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3"><i class="fas fa-shipping-fast me-2"></i>Thông tin giao hàng</h6>
                            <div class="shipping-info">
                                <p class="mb-2"><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                                <p class="mb-2"><strong>Email:</strong> {{ $order->customer_email }}</p>
                                <p class="mb-2"><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                                <p class="mb-2">
                                    <strong>Địa chỉ:</strong> 
                                    {{ $order->shipping_address }}
                                    @if($order->ward), {{ $order->ward }}@endif
                                    @if($order->district), {{ $order->district }}@endif
                                    @if($order->city), {{ $order->city }}@endif
                                </p>
                                @if($order->note)
                                    <p class="mb-0">
                                        <strong>Ghi chú:</strong> 
                                        <span class="text-muted">{{ $order->note }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>Sản phẩm</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">Đơn giá</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-end">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product)
                                                        <img src="{{ $item->product->image_url }}" 
                                                             alt="{{ $item->product_name }}" 
                                                             width="60" height="60" 
                                                             class="me-3 rounded">
                                                    @else
                                                        <div class="bg-light rounded me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $item->product_name }}</strong>
                                                        @if($item->product)
                                                            <br>
                                                            <a href="{{ route('products.show', $item->product_id) }}" 
                                                               class="text-decoration-none small">
                                                                Xem sản phẩm <i class="fas fa-external-link-alt"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                ${{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="text-center align-middle">
                                                × {{ $item->quantity }}
                                            </td>
                                            <td class="text-end align-middle">
                                                <strong>${{ number_format($item->subtotal, 2) }}</strong>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Tổng quan đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="order-summary">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span>${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phí vận chuyển:</span>
                                    <span class="text-success">Miễn phí</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>Tổng cộng:</strong>
                                    <strong class="text-danger fs-5">${{ number_format($order->total_amount, 2) }}</strong>
                                </div>

                                <div class="order-items-count">
                                    <small class="text-muted">
                                        <i class="fas fa-box me-1"></i>
                                        {{ $order->orderItems->count() }} sản phẩm
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($order->status == 'pending')
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Lưu ý:</strong> Đơn hàng của bạn đang chờ xử lý. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.order-detail .card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
}

.order-detail .card-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.order-detail .card-header.bg-primary {
    background: #0d6efd !important;
}

.shipping-info p {
    padding-left: 20px;
    position: relative;
}

.order-summary {
    font-size: 15px;
}

.order-summary hr {
    margin: 15px 0;
}

.table tbody tr {
    border-bottom: 1px solid #f0f0f0;
}

.table tbody tr:last-child {
    border-bottom: none;
}
</style>
@endsection
