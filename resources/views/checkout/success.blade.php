@extends('layouts.app')

@section('content')
<div style="padding-top: 120px;"></div>

<main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <div class="order-complete text-center">
            <div class="order-complete__icon mb-4">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="40" r="40" fill="#198754"/>
                    <path d="M27 40L35 48L53 30" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h2 class="order-complete__title mb-3">Đặt hàng thành công!</h2>
            <p class="order-complete__subtitle mb-4">
                Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đang được xử lý.
            </p>

            <div class="order-info mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6 text-start">
                                        <strong>Mã đơn hàng:</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-primary">{{ $order->order_number }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6 text-start">
                                        <strong>Ngày đặt:</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6 text-start">
                                        <strong>Tổng tiền:</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        <strong class="text-danger">${{ number_format($order->total_amount, 2) }}</strong>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6 text-start">
                                        <strong>Phương thức thanh toán:</strong>
                                    </div>
                                    <div class="col-6 text-end">
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 text-start">
                                        <strong>Trạng thái:</strong>
                                    </div>
                                    <div class="col-6 text-end">
                                        {!! $order->status_badge !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="mb-0">Thông tin giao hàng</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                                <p class="mb-2"><strong>Email:</strong> {{ $order->customer_email }}</p>
                                <p class="mb-2"><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                                <p class="mb-0"><strong>Địa chỉ:</strong> {{ $order->shipping_address }}
                                    @if($order->ward), {{ $order->ward }}@endif
                                    @if($order->district), {{ $order->district }}@endif
                                    @if($order->city), {{ $order->city }}@endif
                                </p>
                                @if($order->note)
                                    <p class="mb-0 mt-2"><strong>Ghi chú:</strong> {{ $order->note }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="mb-0">Chi tiết đơn hàng</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
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
                                                             width="50" height="50" 
                                                             class="me-3 rounded">
                                                    @endif
                                                    <div>
                                                        {{ $item->product_name }}
                                                        <br>
                                                        <small class="text-muted">${{ number_format($item->price, 2) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">× {{ $item->quantity }}</td>
                                            <td class="text-end">${{ number_format($item->subtotal, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="border-top">
                                            <th colspan="2" class="text-end">Tổng cộng:</th>
                                            <th class="text-end text-danger">${{ number_format($order->total_amount, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-complete__actions">
                <a href="{{ route('checkout.orders') }}" class="btn btn-primary me-2">
                    <i class="fas fa-list me-2"></i>Xem đơn hàng của tôi
                </a>
                <a href="/" class="btn btn-outline-primary">
                    <i class="fas fa-home me-2"></i>Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </section>
</main>

<style>
.order-complete {
    padding: 50px 0;
}

.order-complete__icon {
    animation: scaleIn 0.5s ease-in-out;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

.order-complete__title {
    font-size: 32px;
    font-weight: 700;
    color: #198754;
}

.order-complete__subtitle {
    font-size: 16px;
    color: #666;
}

.order-info .card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
}

.order-info .card-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
</style>
@endsection
