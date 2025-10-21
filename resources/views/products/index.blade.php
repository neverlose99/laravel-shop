@extends('layouts.app')

@section('content')

<div class="mb-4 pb-4"></div>

<section class="shop-main container d-flex pt-4 pt-xl-5">
    <div class="shop-list flex-grow-1">
        <div class="mb-3 pb-2 pb-xl-3"></div>

        <div class="d-flex justify-content-between mb-4 pb-md-2">
           
        </div>

        <div class="products-grid row row-cols-2 row-cols-md-3 row-cols-lg-4" id="products-grid">
            @forelse($products as $product)
            <div class="product-card-wrapper">
                <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                    <div class="pc__img-wrapper">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img loading="lazy" src="{{ $product->image_url }}" width="330" height="400"
                                alt="{{ $product->name }}" class="pc__img">
                        </a>
                    </div>

                    <div class="pc__info position-relative">
                        <h6 class="pc__title">
                            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                        </h6>
                        <div class="product-card__price d-flex align-items-center">
                            <span class="money price text-secondary">${{ number_format($product->price, 2) }}</span>
                        </div>
                        <p class="pc__description mt-2">{{ Str::limit($product->description, 80) }}</p>

                        <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                            <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside"
                                data-aside="cartDrawer" title="Thêm vào giỏ">Thêm vào giỏ</button>
                            <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                                data-bs-toggle="modal" data-bs-target="#quickView" title="Xem nhanh">
                                <span class="d-none d-xxl-block">Xem nhanh</span>
                                <span class="d-block d-xxl-none">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_view" />
                                    </svg>
                                </span>
                            </button>
                            <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist" title="Yêu thích">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_heart" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center fs-5">Chưa có sản phẩm nào.</p>
            </div>
            @endforelse
        </div><!-- /.products-grid -->

        <div class="mb-5 pb-xl-5"></div>
    </div>
</section>

@endsection