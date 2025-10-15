<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product; // Import model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get(); // Lấy tất cả sản phẩm, mới nhất lên đầu
        return view('products.index', compact('products')); // Trả về view và truyền dữ liệu
    }
}