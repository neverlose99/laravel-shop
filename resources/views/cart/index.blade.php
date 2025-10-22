@extends('layouts.app')

@section('content')
<div style="padding-top: 120px;"></div>

<main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Shopping Cart</h2>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($cartItems->count() > 0)
        <div class="shopping-cart">
            <div class="cart-table__wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="{{ $item->product->image_url }}" width="120" height="120" alt="{{ $item->product->name }}" />
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4><a href="{{ route('products.show', $item->product->id) }}">{{ $item->product->name }}</a></h4>
                                    <div class="mt-2">
                                        @if($item->product->stock > 0)
                                            <small class="text-success">
                                                <i class="fas fa-check-circle"></i>
                                                Còn {{ $item->product->stock }} sản phẩm
                                            </small>
                                        @else
                                            <small class="text-danger">
                                                <i class="fas fa-times-circle"></i>
                                                Hết hàng
                                            </small>
                                        @endif
                                        
                                        @if($item->quantity > $item->product->stock)
                                            <br>
                                            <small class="text-warning">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Số lượng trong giỏ vượt quá tồn kho!
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">${{ number_format($item->product->price, 2) }}</span>
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline cart-update-form" data-max-stock="{{ $item->product->stock }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" 
                                               name="quantity" 
                                               value="{{ $item->quantity }}" 
                                               min="1" 
                                               max="{{ $item->product->stock }}"
                                               class="qty-control__number text-center cart-quantity-input" 
                                               style="width: 80px;"
                                               onchange="validateAndSubmit(this)">
                                    </form>
                                    
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger remove-cart" 
                                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.259435 8.85506L8.85506 0.259435" stroke="currentColor" stroke-width="0.5" />
                                            <path d="M0.259435 0.259435L8.85506 8.85506" stroke="currentColor" stroke-width="0.5" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-table-footer">
                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light" 
                                onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')">
                            CLEAR SHOPPING CART
                        </button>
                    </form>
                    <a href="{{ route('products.index') }}" class="btn btn-light">CONTINUE SHOPPING</a>
                </div>
            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>Cart Totals</h3>
                        <table class="cart-totals">
                            <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>${{ number_format($total, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>Free shipping</td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>$0</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>${{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-checkout">TIẾN HÀNH THANH TOÁN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-info text-center py-5">
            <h4>Giỏ hàng của bạn đang trống</h4>
            <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
        </div>
        @endif
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>

<script>
function validateAndSubmit(input) {
    const form = input.closest('form');
    const maxStock = parseInt(form.dataset.maxStock);
    const quantity = parseInt(input.value);
    
    if (quantity > maxStock) {
        alert('Số lượng yêu cầu vượt quá tồn kho. Tồn kho hiện tại: ' + maxStock);
        input.value = maxStock;
    } else if (quantity < 1) {
        alert('Số lượng tối thiểu là 1');
        input.value = 1;
        return false;
    }
    
    form.submit();
}

// Thêm sự kiện cho các nút tăng giảm nếu có
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cart-update-form').forEach(form => {
        const input = form.querySelector('.cart-quantity-input');
        const maxStock = parseInt(form.dataset.maxStock);
        
        // Kiểm tra khi người dùng nhập trực tiếp
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                validateAndSubmit(this);
            }
        });
    });
});
</script>

<style>
.shopping-cart__product-item__detail small {
    font-size: 13px;
}

.shopping-cart__product-item__detail .text-success {
    color: #198754 !important;
}

.shopping-cart__product-item__detail .text-danger {
    color: #dc3545 !important;
}

.shopping-cart__product-item__detail .text-warning {
    color: #ffc107 !important;
}

.cart-quantity-input {
    padding: 5px;
}

.qty-control small {
    font-size: 11px;
}
</style>

@endsection
