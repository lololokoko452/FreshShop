<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status', true)->get();
        $products = Product::all();
        $categories = Category::all();
        return view("client.home", compact("sliders", "products", "categories"));
    }
}
