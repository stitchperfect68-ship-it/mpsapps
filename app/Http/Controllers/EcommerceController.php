<?php

namespace App\Http\Controllers;

use App\Models\EcommerceOrder;
use App\Models\Product;
use App\Models\RetailCustomer;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index() { return view('ecommerce.index', ['orders' => EcommerceOrder::latest()->paginate(10)]); }
    public function products() { return view('ecommerce.products', ['products' => Product::latest()->paginate(20)]); }
    public function createProduct() { return view('ecommerce.create-product'); }
    public function storeProduct(Request $request) { return redirect()->route('ecommerce.products'); }
    public function editProduct(Product $product) { return view('ecommerce.edit-product', compact('product')); }
    public function updateProduct(Request $request, Product $product) { return redirect()->route('ecommerce.products'); }
    public function destroyProduct(Product $product) { return redirect()->route('ecommerce.products'); }
    public function orders() { return view('ecommerce.orders', ['orders' => EcommerceOrder::latest()->paginate(20)]); }
    public function showOrder(EcommerceOrder $order) { return view('ecommerce.index', compact('order')); }
    public function updateOrderStatus(Request $request, EcommerceOrder $order) { return back(); }
    public function categories() { return view('ecommerce.index', ['orders' => collect()]); }
    public function customers() { return view('ecommerce.index', ['orders' => collect()]); }
    public function searchProducts() { return response()->json([]); }
}
