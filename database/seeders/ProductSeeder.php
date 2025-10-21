<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Cropped Faux Leather Jacket',
                'description' => 'Áo khoác da giả cắt ngắn thời trang, phong cách hiện đại, phù hợp cho mọi dịp.',
                'price' => 29.00,
                'image' => 'assets/images/home/demo3/product-0-1.jpg',
                'stock' => 12,
            ],
            [
                'name' => 'Calvin Shorts',
                'description' => 'Quần short Calvin phong cách trẻ trung, chất liệu thoáng mát, thoải mái.',
                'price' => 62.00,
                'image' => 'assets/images/home/demo3/product-1-1.jpg',
                'stock' => 8,
            ],
            [
                'name' => 'Kirby T-Shirt',
                'description' => 'Áo thun Kirby họa tiết đáng yêu, chất liệu cotton mềm mại, thấm hút mồ hôi tốt.',
                'price' => 17.00,
                'image' => 'assets/images/home/demo3/product-2-1.jpg',
                'stock' => 24,
            ],
            [
                'name' => 'Cableknit Shawl',
                'description' => 'Khăn len dệt kim cao cấp, giữ ấm tốt, thiết kế sang trọng và tinh tế.',
                'price' => 99.00,
                'image' => 'assets/images/home/demo3/product-3-1.jpg',
                'stock' => 5,
            ],
            [
                'name' => 'Women Faux Leather Jacket',
                'description' => 'Áo khoác da giả nữ sang trọng, phong cách cá tính, thích hợp cho mùa thu đông.',
                'price' => 35.00,
                'image' => 'assets/images/home/demo3/product-4.jpg',
                'stock' => 18,
            ],
            [
                'name' => 'Calvin Classic Shorts',
                'description' => 'Quần short Calvin phiên bản cổ điển, thiết kế đơn giản nhưng không kém phần thời trang.',
                'price' => 68.00,
                'image' => 'assets/images/home/demo3/product-5.jpg',
                'stock' => 7,
            ],
            [
                'name' => 'Kirby White T-Shirt',
                'description' => 'Áo thun trắng Kirby basic, dễ phối đồ, chất liệu cotton 100% thoáng mát.',
                'price' => 20.00,
                'image' => 'assets/images/home/demo3/product-6.jpg',
                'stock' => 30,
            ],
            [
                'name' => 'Premium Cableknit Shawl',
                'description' => 'Khăn len cao cấp dệt kim tinh xảo, màu sắc nhẹ nhàng, phù hợp mọi lứa tuổi.',
                'price' => 129.00,
                'image' => 'assets/images/home/demo3/product-7.jpg',
                'stock' => 3,
            ],
            [
                'name' => 'Stylish Leather Jacket',
                'description' => 'Áo khoác da phong cách thời trang, thiết kế trẻ trung, năng động.',
                'price' => 45.00,
                'image' => 'assets/images/home/demo3/product-8.jpg',
                'stock' => 15,
            ],
            [
                'name' => 'Summer Calvin Shorts',
                'description' => 'Quần short Calvin mùa hè, chất liệu siêu nhẹ, thoáng mát cho những ngày nóng.',
                'price' => 55.00,
                'image' => 'assets/images/home/demo3/product-9.jpg',
                'stock' => 20,
            ],
            [
                'name' => 'Kirby Graphic T-Shirt',
                'description' => 'Áo thun Kirby in hình đẹp mắt, form rộng thoải mái, phong cách streetwear.',
                'price' => 22.00,
                'image' => 'assets/images/home/demo3/product-10.jpg',
                'stock' => 14,
            ],
            [
                'name' => 'Winter Cableknit Shawl',
                'description' => 'Khăn len mùa đông ấm áp, thiết kế độc đáo, màu sắc trung tính dễ phối đồ.',
                'price' => 149.00,
                'image' => 'assets/images/home/demo3/product-11.jpg',
                'stock' => 6,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
