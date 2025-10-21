@extends('layouts.app')

@section('content')
<div style="padding-top: 120px;"></div>

<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title mb-4">Đơn hàng của tôi</h2>

        @if($orders->count() > 0)
        <div class="orders-table">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <strong>{{ $order->order_number }}</strong>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <strong class="text-danger">${{ number_format($order->total_amount, 2) }}</strong>
                        </td>
                        <td>
                            @switch($order->payment_method)
                                @case('cod')
                                    <span class="badge bg-info">COD</span>
                                    @break
                                @case('bank_transfer')
                                    <span class="badge bg-primary">Chuyển khoản</span>
                                    @break
                                @case('momo')
                                    <span class="badge bg-danger">MoMo</span>
                                    @break
                                @case('vnpay')
                                    <span class="badge bg-success">VNPay</span>
                                    @break
                            @endswitch
                            <br>
                            <small>{!! $order->payment_status_badge !!}</small>
                        </td>
                        <td>{!! $order->status_badge !!}</td>
                        <td class="text-center">
                            <a href="{{ route('checkout.order.detail', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
        @else
        <div class="alert alert-info text-center">
            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
            <h5>Bạn chưa có đơn hàng nào</h5>
            <p>Hãy bắt đầu mua sắm ngay!</p>
            <a href="/" class="btn btn-primary mt-2">Mua sắm ngay</a>
        </div>
        @endif
    </section>
</main>

<style>
.orders-table {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.orders-table table {
    margin-bottom: 0;
}

.orders-table th {
    font-weight: 600;
    color: #222;
    border-bottom: 2px solid #dee2e6;
}

.orders-table td {
    vertical-align: middle;
}
</style>
@endsection
