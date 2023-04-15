<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\Controller;
use App\Models\Product;
use App\Models\Slider;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status', true)->get();
        $products = Product::all();
        return view("client.home", compact("sliders", "products"));
    }

    public function shop()
    {
        $products = Product::all();
        return view("client.shop", compact("products"));
    }

    public function cart()
    {
        return view("client.cart.index");
    }

    public function checkout()
    {
        return view("client.checkout");
    }

    public function register()
    {
        return view("client.register");
    }

    public function signin()
    {
        return view("client.signin");
    }
}
