@extends('layouts.app')

@section('content')
<div style="padding-top: 120px;"></div>

<main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Checkout</h2>
        <div class="checkout-steps">
            <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Shipping and Checkout</span>
                    <em>Checkout Your Items List</em>
                </span>
            </a>
            <a href="javascript:void(0)" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Confirmation</span>
                    <em>Review And Submit Your Order</em>
                </span>
            </a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST" class="checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <h3 class="mb-4">Thông tin giao hàng</h3>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                               id="customer_name" name="customer_name" placeholder="Họ và tên" 
                               value="{{ old('customer_name', Auth::user()->name) }}" required>
                        <label for="customer_name">Họ và tên *</label>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('customer_email') is-invalid @enderror" 
                                       id="customer_email" name="customer_email" placeholder="Email" 
                                       value="{{ old('customer_email', Auth::user()->email) }}" required>
                                <label for="customer_email">Email *</label>
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="tel" 
                                       class="form-control @error('customer_phone') is-invalid @enderror" 
                                       id="customer_phone" 
                                       name="customer_phone" 
                                       placeholder="Số điện thoại" 
                                       value="{{ old('customer_phone') }}" 
                                       pattern="[0-9]{10,12}"
                                       maxlength="12"
                                       required>
                                <label for="customer_phone">Số điện thoại (10-12 chữ số) *</label>
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Ví dụ: 0901234567 hoặc 840901234567</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                  id="shipping_address" 
                                  name="shipping_address" 
                                  placeholder="Địa chỉ" 
                                  style="height: 80px"
                                  minlength="6"
                                  required>{{ old('shipping_address') }}</textarea>
                        <label for="shipping_address">Số nhà, tên đường *</label>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <small class="text-muted">Ví dụ: 123 Lê Lợi, 45A Trần Hưng Đạo</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <select class="form-select @error('city') is-invalid @enderror" 
                                        id="city" 
                                        name="city" 
                                        required>
                                    <option value="">-- Chọn Tỉnh/Thành phố --</option>
                                    <option value="Hồ Chí Minh" {{ old('city') == 'Hồ Chí Minh' ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
                                    <option value="Hà Nội" {{ old('city') == 'Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
                                    <option value="Đà Nẵng" {{ old('city') == 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
                                    <option value="Cần Thơ" {{ old('city') == 'Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
                                    <option value="Hải Phòng" {{ old('city') == 'Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
                                    <option value="An Giang" {{ old('city') == 'An Giang' ? 'selected' : '' }}>An Giang</option>
                                    <option value="Bà Rịa - Vũng Tàu" {{ old('city') == 'Bà Rịa - Vũng Tàu' ? 'selected' : '' }}>Bà Rịa - Vũng Tàu</option>
                                    <option value="Bắc Giang" {{ old('city') == 'Bắc Giang' ? 'selected' : '' }}>Bắc Giang</option>
                                    <option value="Bắc Kạn" {{ old('city') == 'Bắc Kạn' ? 'selected' : '' }}>Bắc Kạn</option>
                                    <option value="Bạc Liêu" {{ old('city') == 'Bạc Liêu' ? 'selected' : '' }}>Bạc Liêu</option>
                                    <option value="Bắc Ninh" {{ old('city') == 'Bắc Ninh' ? 'selected' : '' }}>Bắc Ninh</option>
                                    <option value="Bến Tre" {{ old('city') == 'Bến Tre' ? 'selected' : '' }}>Bến Tre</option>
                                    <option value="Bình Định" {{ old('city') == 'Bình Định' ? 'selected' : '' }}>Bình Định</option>
                                    <option value="Bình Dương" {{ old('city') == 'Bình Dương' ? 'selected' : '' }}>Bình Dương</option>
                                    <option value="Bình Phước" {{ old('city') == 'Bình Phước' ? 'selected' : '' }}>Bình Phước</option>
                                    <option value="Bình Thuận" {{ old('city') == 'Bình Thuận' ? 'selected' : '' }}>Bình Thuận</option>
                                    <option value="Cà Mau" {{ old('city') == 'Cà Mau' ? 'selected' : '' }}>Cà Mau</option>
                                    <option value="Cao Bằng" {{ old('city') == 'Cao Bằng' ? 'selected' : '' }}>Cao Bằng</option>
                                    <option value="Đắk Lắk" {{ old('city') == 'Đắk Lắk' ? 'selected' : '' }}>Đắk Lắk</option>
                                    <option value="Đắk Nông" {{ old('city') == 'Đắk Nông' ? 'selected' : '' }}>Đắk Nông</option>
                                    <option value="Điện Biên" {{ old('city') == 'Điện Biên' ? 'selected' : '' }}>Điện Biên</option>
                                    <option value="Đồng Nai" {{ old('city') == 'Đồng Nai' ? 'selected' : '' }}>Đồng Nai</option>
                                    <option value="Đồng Tháp" {{ old('city') == 'Đồng Tháp' ? 'selected' : '' }}>Đồng Tháp</option>
                                    <option value="Gia Lai" {{ old('city') == 'Gia Lai' ? 'selected' : '' }}>Gia Lai</option>
                                    <option value="Hà Giang" {{ old('city') == 'Hà Giang' ? 'selected' : '' }}>Hà Giang</option>
                                    <option value="Hà Nam" {{ old('city') == 'Hà Nam' ? 'selected' : '' }}>Hà Nam</option>
                                    <option value="Hà Tĩnh" {{ old('city') == 'Hà Tĩnh' ? 'selected' : '' }}>Hà Tĩnh</option>
                                    <option value="Hải Dương" {{ old('city') == 'Hải Dương' ? 'selected' : '' }}>Hải Dương</option>
                                    <option value="Hậu Giang" {{ old('city') == 'Hậu Giang' ? 'selected' : '' }}>Hậu Giang</option>
                                    <option value="Hòa Bình" {{ old('city') == 'Hòa Bình' ? 'selected' : '' }}>Hòa Bình</option>
                                    <option value="Hưng Yên" {{ old('city') == 'Hưng Yên' ? 'selected' : '' }}>Hưng Yên</option>
                                    <option value="Khánh Hòa" {{ old('city') == 'Khánh Hòa' ? 'selected' : '' }}>Khánh Hòa</option>
                                    <option value="Kiên Giang" {{ old('city') == 'Kiên Giang' ? 'selected' : '' }}>Kiên Giang</option>
                                    <option value="Kon Tum" {{ old('city') == 'Kon Tum' ? 'selected' : '' }}>Kon Tum</option>
                                    <option value="Lai Châu" {{ old('city') == 'Lai Châu' ? 'selected' : '' }}>Lai Châu</option>
                                    <option value="Lâm Đồng" {{ old('city') == 'Lâm Đồng' ? 'selected' : '' }}>Lâm Đồng</option>
                                    <option value="Lạng Sơn" {{ old('city') == 'Lạng Sơn' ? 'selected' : '' }}>Lạng Sơn</option>
                                    <option value="Lào Cai" {{ old('city') == 'Lào Cai' ? 'selected' : '' }}>Lào Cai</option>
                                    <option value="Long An" {{ old('city') == 'Long An' ? 'selected' : '' }}>Long An</option>
                                    <option value="Nam Định" {{ old('city') == 'Nam Định' ? 'selected' : '' }}>Nam Định</option>
                                    <option value="Nghệ An" {{ old('city') == 'Nghệ An' ? 'selected' : '' }}>Nghệ An</option>
                                    <option value="Ninh Bình" {{ old('city') == 'Ninh Bình' ? 'selected' : '' }}>Ninh Bình</option>
                                    <option value="Ninh Thuận" {{ old('city') == 'Ninh Thuận' ? 'selected' : '' }}>Ninh Thuận</option>
                                    <option value="Phú Thọ" {{ old('city') == 'Phú Thọ' ? 'selected' : '' }}>Phú Thọ</option>
                                    <option value="Phú Yên" {{ old('city') == 'Phú Yên' ? 'selected' : '' }}>Phú Yên</option>
                                    <option value="Quảng Bình" {{ old('city') == 'Quảng Bình' ? 'selected' : '' }}>Quảng Bình</option>
                                    <option value="Quảng Nam" {{ old('city') == 'Quảng Nam' ? 'selected' : '' }}>Quảng Nam</option>
                                    <option value="Quảng Ngãi" {{ old('city') == 'Quảng Ngãi' ? 'selected' : '' }}>Quảng Ngãi</option>
                                    <option value="Quảng Ninh" {{ old('city') == 'Quảng Ninh' ? 'selected' : '' }}>Quảng Ninh</option>
                                    <option value="Quảng Trị" {{ old('city') == 'Quảng Trị' ? 'selected' : '' }}>Quảng Trị</option>
                                    <option value="Sóc Trăng" {{ old('city') == 'Sóc Trăng' ? 'selected' : '' }}>Sóc Trăng</option>
                                    <option value="Sơn La" {{ old('city') == 'Sơn La' ? 'selected' : '' }}>Sơn La</option>
                                    <option value="Tây Ninh" {{ old('city') == 'Tây Ninh' ? 'selected' : '' }}>Tây Ninh</option>
                                    <option value="Thái Bình" {{ old('city') == 'Thái Bình' ? 'selected' : '' }}>Thái Bình</option>
                                    <option value="Thái Nguyên" {{ old('city') == 'Thái Nguyên' ? 'selected' : '' }}>Thái Nguyên</option>
                                    <option value="Thanh Hóa" {{ old('city') == 'Thanh Hóa' ? 'selected' : '' }}>Thanh Hóa</option>
                                    <option value="Thừa Thiên Huế" {{ old('city') == 'Thừa Thiên Huế' ? 'selected' : '' }}>Thừa Thiên Huế</option>
                                    <option value="Tiền Giang" {{ old('city') == 'Tiền Giang' ? 'selected' : '' }}>Tiền Giang</option>
                                    <option value="Trà Vinh" {{ old('city') == 'Trà Vinh' ? 'selected' : '' }}>Trà Vinh</option>
                                    <option value="Tuyên Quang" {{ old('city') == 'Tuyên Quang' ? 'selected' : '' }}>Tuyên Quang</option>
                                    <option value="Vĩnh Long" {{ old('city') == 'Vĩnh Long' ? 'selected' : '' }}>Vĩnh Long</option>
                                    <option value="Vĩnh Phúc" {{ old('city') == 'Vĩnh Phúc' ? 'selected' : '' }}>Vĩnh Phúc</option>
                                    <option value="Yên Bái" {{ old('city') == 'Yên Bái' ? 'selected' : '' }}>Yên Bái</option>
                                </select>
                                @error('city')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <input type="text" 
                                       class="form-control @error('district') is-invalid @enderror" 
                                       id="district" 
                                       name="district" 
                                       placeholder="Quận/Huyện *" 
                                       value="{{ old('district') }}"
                                       required>
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <input type="text" 
                                       class="form-control @error('ward') is-invalid @enderror" 
                                       id="ward" 
                                       name="ward" 
                                       placeholder="Phường/Xã" 
                                       value="{{ old('ward') }}">
                                @error('ward')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control @error('note') is-invalid @enderror" 
                                  id="note" name="note" placeholder="Ghi chú" 
                                  style="height: 100px">{{ old('note') }}</textarea>
                        <label for="note">Ghi chú đơn hàng (tùy chọn)</label>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h3 class="mb-3">Phương thức thanh toán</h3>
                    <div class="payment-methods mb-4">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" 
                                   id="payment_cod" value="cod" 
                                   {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="payment_cod">
                                <strong>Thanh toán khi nhận hàng (COD)</strong>
                                <p class="text-muted mb-0">Thanh toán bằng tiền mặt khi nhận hàng</p>
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" 
                                   id="payment_bank" value="bank_transfer"
                                   {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_bank">
                                <strong>Chuyển khoản ngân hàng</strong>
                                <p class="text-muted mb-0">Chuyển khoản trực tiếp vào tài khoản ngân hàng</p>
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" 
                                   id="payment_momo" value="momo"
                                   {{ old('payment_method') == 'momo' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_momo">
                                <strong>Ví điện tử MoMo</strong>
                                <p class="text-muted mb-0">Thanh toán qua ví MoMo</p>
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" 
                                   id="payment_vnpay" value="vnpay"
                                   {{ old('payment_method') == 'vnpay' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_vnpay">
                                <strong>VNPay</strong>
                                <p class="text-muted mb-0">Thanh toán qua cổng VNPay</p>
                            </label>
                        </div>
                        @error('payment_method')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="checkout-totals-wrapper">
                        <div class="sticky-content">
                            <h3 class="mb-4">Đơn hàng của bạn</h3>
                            <div class="checkout-totals">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                {{ $item->product->name }} × {{ $item->quantity }}
                                            </td>
                                            <td>
                                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tạm tính</th>
                                            <td>${{ number_format($total, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phí vận chuyển</th>
                                            <td>Miễn phí</td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Tổng cộng</th>
                                            <td class="fw-bold fs-5">${{ number_format($total, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 mt-3">
                                Đặt hàng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('customer_phone');
    const form = document.querySelector('.checkout-form');
    
    // Chỉ cho phép nhập số cho phone
    phoneInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Giới hạn 12 số
        if (this.value.length > 12) {
            this.value = this.value.slice(0, 12);
        }
    });
    
    // Validate phone trước khi submit
    form.addEventListener('submit', function(e) {
        const phone = phoneInput.value;
        
        if (phone.length < 10 || phone.length > 12) {
            e.preventDefault();
            phoneInput.classList.add('is-invalid');
            
            // Tạo hoặc cập nhật error message
            let errorDiv = phoneInput.nextElementSibling;
            if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                phoneInput.parentNode.appendChild(errorDiv);
            }
            errorDiv.textContent = 'Số điện thoại phải có từ 10-12 chữ số';
            errorDiv.style.display = 'block';
            
            phoneInput.focus();
            return false;
        }
        
        // Kiểm tra các trường required
        const requiredFields = form.querySelectorAll('[required]');
        let hasError = false;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                hasError = true;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (hasError) {
            e.preventDefault();
            alert('Vui lòng điền đầy đủ thông tin bắt buộc (*)');
            return false;
        }
    });
    
    // Remove invalid class khi user nhập
    const allInputs = form.querySelectorAll('input, select, textarea');
    allInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>

<style>
.checkout-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 50px;
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.checkout-steps__item {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #999;
    flex: 1;
    position: relative;
}

.checkout-steps__item.active {
    color: #222;
}

.checkout-steps__item:not(:last-child)::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    width: 100%;
    height: 1px;
    background: #e0e0e0;
    z-index: -1;
}

.checkout-steps__item-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f5f5f5;
    color: #999;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 15px;
    flex-shrink: 0;
}

.checkout-steps__item.active .checkout-steps__item-number {
    background: #222;
    color: #fff;
}

.checkout-steps__item-title {
    display: flex;
    flex-direction: column;
}

.checkout-steps__item-title span {
    font-weight: 600;
    font-size: 14px;
}

.checkout-steps__item-title em {
    font-style: normal;
    font-size: 12px;
    color: #999;
}

.checkout-totals-wrapper {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 8px;
}

.checkout-totals table {
    margin-bottom: 0;
}

.checkout-totals tbody td,
.checkout-totals tbody th {
    padding: 12px 0;
    border-bottom: 1px solid #dee2e6;
}

.checkout-totals tfoot th,
.checkout-totals tfoot td {
    padding: 12px 0;
    border: none;
}

.checkout-totals .order-total {
    border-top: 2px solid #222;
}

.payment-methods .form-check {
    padding: 15px;
    border: 1px solid #dee2e6;
    border-radius: 5px;
}

.payment-methods .form-check-input:checked ~ .form-check-label {
    color: #222;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    opacity: .65;
    transform: scale(.85) translateY(-.5rem) translateX(.15rem);
}

.form-select {
    height: 48px;
    padding: 0.75rem;
    font-size: 15px;
    border: 1px solid #dee2e6;
    border-radius: 4px;
}

.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-control, .form-select {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

input[type="tel"]::placeholder {
    color: #999;
}

textarea.form-control {
    resize: vertical;
    min-height: 80px;
}

small.text-muted {
    font-size: 12px;
    color: #6c757d !important;
}
</style>
@endsection
