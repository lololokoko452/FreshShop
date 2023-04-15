<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

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
        return view("client.cart");
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
