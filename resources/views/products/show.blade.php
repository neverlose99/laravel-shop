@extends('layouts.app')

@section('content')

<div style="padding-top: 120px;"></div>

<section class="product-single container">
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

    <div class="row mb-4">
        <div class="col-12 text-center">
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-7">
            <div class="product-single__media" data-media-type="vertical-thumbnail">
                <div class="product-single__image">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide product-single__image-item">
                                <img loading="lazy" class="h-auto" src="{{ $product->image_url }}" width="674" height="674" alt="{{ $product->name }}" />
                                <a data-fancybox="gallery" href="{{ $product->image_url }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_zoom" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <h1 class="product-single__name">{{ $product->name }}</h1>

            <div class="product-single__price">
                <span class="current-price">${{ number_format($product->price, 2) }}</span>
            </div>

            <div class="product-single__short-desc">
                <p class="mb-4">{{ $product->description }}</p>
            </div>

            <!-- Hiển thị tồn kho -->
            <div class="product-single__stock mb-3">
                @if($product->stock > 0)
                    <span class="stock-status in-stock">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Tình trạng:</strong> Còn hàng 
                        <span class="badge bg-success ms-2">{{ $product->stock }} sản phẩm</span>
                    </span>
                @else
                    <span class="stock-status out-of-stock">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Tình trạng:</strong> Hết hàng
                    </span>
                @endif
            </div>

            <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="product-single__addtocart">
                    <div class="qty-control position-relative">
                        <input type="number" 
                               name="quantity" 
                               value="1" 
                               min="1" 
                               max="{{ $product->stock }}"
                               {{ $product->stock == 0 ? 'disabled' : '' }}
                               class="qty-control__number text-center"
                               id="quantityInput">
                        <div class="qty-control__reduce">-</div>
                        <div class="qty-control__increase">+</div>
                    </div>

                    <button type="submit" 
                            class="btn btn-primary btn-addtocart" 
                            {{ $product->stock == 0 ? 'disabled' : '' }}>
                        @if($product->stock > 0)
                            Thêm vào giỏ hàng
                        @else
                            Hết hàng
                        @endif
                    </button>
                </div>
            </form>

            <div class="product-single__addtolinks">
                <a href="#" class="menu-link menu-link_us-s add-to-wishlist">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_heart" />
                    </svg>
                    <span>Thêm vào yêu thích</span>
                </a>
                <share-button class="share-button">
                    <button class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                        <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_sharing" />
                        </svg>
                        <span>Chia sẻ</span>
                    </button>
                </share-button>
            </div>

            <div class="product-single__meta-info">
                <div class="meta-item">
                    <label>SKU:</label>
                    <span>{{ $product->id }}</span>
                </div>
                <div class="meta-item">
                    <label>Danh mục:</label>
                    <span>Quần áo</span>
                </div>
                <div class="meta-item">
                    <label>Tags:</label>
                    <span>Thời trang, Mới</span>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript để kiểm soát số lượng -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const maxStock = {{ $product->stock }};
        const quantityInput = document.getElementById('quantityInput');
        const increaseBtn = document.querySelector('.qty-control__increase');
        const decreaseBtn = document.querySelector('.qty-control__reduce');
        const form = document.getElementById('addToCartForm');

        if (increaseBtn && decreaseBtn && quantityInput) {
            increaseBtn.addEventListener('click', function() {
                let currentVal = parseInt(quantityInput.value) || 1;
                if (currentVal < maxStock) {
                    quantityInput.value = currentVal + 1;
                } else {
                    alert('Số lượng tối đa trong kho là ' + maxStock + ' sản phẩm');
                }
            });

            decreaseBtn.addEventListener('click', function() {
                let currentVal = parseInt(quantityInput.value) || 1;
                if (currentVal > 1) {
                    quantityInput.value = currentVal - 1;
                }
            });

            // Kiểm tra khi người dùng nhập trực tiếp
            quantityInput.addEventListener('change', function() {
                let value = parseInt(this.value) || 1;
                if (value > maxStock) {
                    this.value = maxStock;
                    alert('Số lượng tối đa trong kho là ' + maxStock + ' sản phẩm');
                } else if (value < 1) {
                    this.value = 1;
                }
            });

            // Kiểm tra trước khi submit
            form.addEventListener('submit', function(e) {
                let quantity = parseInt(quantityInput.value) || 1;
                if (quantity > maxStock) {
                    e.preventDefault();
                    alert('Số lượng yêu cầu vượt quá tồn kho. Tồn kho hiện tại: ' + maxStock);
                    quantityInput.value = maxStock;
                }
            });
        }
    });
    </script>

    <style>
    .product-single__stock {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #198754;
    }

    .product-single__stock .stock-status {
        font-size: 15px;
        color: #222;
    }

    .product-single__stock .stock-status.in-stock i {
        color: #198754;
    }

    .product-single__stock .stock-status.out-of-stock {
        border-left-color: #dc3545;
    }

    .product-single__stock .stock-status.out-of-stock i {
        color: #dc3545;
    }

    .qty-control__number:disabled {
        background: #e9ecef;
        cursor: not-allowed;
    }

    .btn-addtocart:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    </style>

    <div class="product-single__details-tab">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab" href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Mô tả</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab" href="#tab-additional-info" role="tab" aria-controls="tab-additional-info" aria-selected="false">Thông tin thêm</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab" href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Đánh giá (0)</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-description" role="tabpanel" aria-labelledby="tab-description-tab">
                <div class="product-single__description">
                    <h3 class="block-title mb-4">Mô tả sản phẩm</h3>
                    <p class="content">{{ $product->description }}</p>
                    
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <h5 class="mb-3">Đặc điểm:</h5>
                            <ul>
                                <li>Chất liệu cao cấp</li>
                                <li>Thiết kế hiện đại</li>
                                <li>Dễ dàng phối đồ</li>
                                <li>Phù hợp nhiều dịp</li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="mb-3">Hướng dẫn bảo quản:</h5>
                            <ul>
                                <li>Giặt tay hoặc giặt máy ở chế độ nhẹ</li>
                                <li>Không sử dụng chất tẩy</li>
                                <li>Phơi nơi thoáng mát</li>
                                <li>Ủi ở nhiệt độ thấp</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
                <div class="product-single__additional-info">
                    <h3 class="block-title mb-4">Thông tin chi tiết</h3>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Giá</th>
                                <td>${{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Kích thước</th>
                                <td>S, M, L, XL</td>
                            </tr>
                            <tr>
                                <th>Màu sắc</th>
                                <td>Đen, Trắng, Xám</td>
                            </tr>
                            <tr>
                                <th>Chất liệu</th>
                                <td>Cotton 100%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                <div class="product-single__reviews">
                    <h3 class="block-title mb-4">Đánh giá khách hàng</h3>
                    <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="mb-5 pb-xl-5"></div>

@endsection
