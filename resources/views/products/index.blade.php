<h1>Danh sách sản phẩm</h1>

@if($products->count())
    @foreach($products as $product)
        <div>
            <h2>{{ $product->name }}</h2>
            <p>Giá: {{ number_format($product->price) }} VNĐ</p>
            <p>{{ $product->description }}</p>
        </div>
        <hr>
    @endforeach
@else
    <p>Chưa có sản phẩm nào.</p>
@endif