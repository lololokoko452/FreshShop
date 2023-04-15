<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Admin\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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

    public function update(ProductRequest $request, ProductService $productService, Product $product): RedirectResponse
    {
        try {
            $productService->updateProduct($request, $product);

            return redirect()->route('admin.product.index', $product)->with('success', 'Product modified.');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.edit', $product)->with('error', 'Error');
        }
    }

    public function delete(Product $product)
    {
        Storage::delete("public/product_images/$product->imageName");
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted !');
    }
}
