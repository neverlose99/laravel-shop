@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Chi tiết đơn hàng: {{ $order->order_number }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>Sản phẩm đã đặt</h5>
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
                                                <div class="bg-light rounded me-3" style="width: 60px; height: 60px;"></div>
                                            @endif
                                            <div>
                                                <strong>{{ $item->product_name }}</strong>
                                                @if($item->product)
                                                    <br>
                                                    <a href="{{ route('products.show', $item->product_id) }}" 
                                                       class="text-decoration-none small" target="_blank">
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
                            <tfoot>
                                <tr class="border-top">
                                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                    <td class="text-end">
                                        <strong class="text-danger fs-5">${{ number_format($order->total_amount, 2) }}</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>Thông tin giao hàng</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Người nhận</label>
                            <p class="mb-0"><strong>{{ $order->customer_name }}</strong></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Số điện thoại</label>
                            <p class="mb-0"><strong>{{ $order->customer_phone }}</strong></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="text-muted small">Email</label>
                            <p class="mb-0"><strong>{{ $order->customer_email }}</strong></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="text-muted small">Địa chỉ giao hàng</label>
                            <p class="mb-0">
                                {{ $order->shipping_address }}
                                @if($order->ward), {{ $order->ward }}@endif
                                @if($order->district), {{ $order->district }}@endif
                                @if($order->city), {{ $order->city }}@endif
                            </p>
                        </div>
                        @if($order->note)
                        <div class="col-md-12">
                            <label class="text-muted small">Ghi chú</label>
                            <p class="mb-0 text-muted">{{ $order->note }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Mã đơn hàng</label>
                        <p class="mb-0">
                            <strong class="text-primary">{{ $order->order_number }}</strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Ngày đặt</label>
                        <p class="mb-0">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Khách hàng</label>
                        <p class="mb-0">
                            @if($order->user)
                                <a href="#">{{ $order->user->name }}</a>
                            @else
                                Khách vãng lai
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Phương thức thanh toán</label>
                        <p class="mb-0">
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
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Cập nhật trạng thái</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <label class="form-label">Trạng thái đơn hàng</label>
                        <select name="status" class="form-select mb-2">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Cập nhật
                        </button>
                    </form>

                    <form action="{{ route('admin.orders.updatePaymentStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label class="form-label">Trạng thái thanh toán</label>
                        <select name="payment_status" class="form-select mb-2">
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                        </select>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save me-2"></i>Cập nhật
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Tổng quan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển:</span>
                        <span class="text-success">Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Tổng cộng:</strong>
                        <strong class="text-danger fs-5">${{ number_format($order->total_amount, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
