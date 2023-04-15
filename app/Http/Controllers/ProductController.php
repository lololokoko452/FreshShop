<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Admin\ProductService;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("admin.product.index", compact("products"));
    }

    public function form(Product|null $product): View
    {
        $formAction = $product?->id ? route('admin.product.update', $product) : route('admin.product.store');
        $categories = Category::all();
        return view("admin.product.form", compact("product", "formAction", "categories"));
    }

    public function store(ProductRequest $request, ProductService $productService)
    {
        try {
            $productService->saveNewProduct($request);

            return redirect()->route('admin.product.index')->with('success', 'Product created successfuly');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.new')->with('error', 'Error');
        }
    }
}
