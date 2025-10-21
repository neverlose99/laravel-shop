@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Quản lý đơn hàng</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <strong>{{ $order->order_number }}</strong>
                            </td>
                            <td>
                                {{ $order->customer_name }}<br>
                                <small class="text-muted">{{ $order->customer_email }}</small>
                            </td>
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
                                {!! $order->payment_status_badge !!}
                            </td>
                            <td>{!! $order->status_badge !!}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                Chưa có đơn hàng nào
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
