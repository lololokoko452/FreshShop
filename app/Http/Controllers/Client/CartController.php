<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        return view("client.cart.index");
    }

    public function checkout()
    {
        if (Session::has('client')){
            return view("client.cart.checkout");
        }
        return redirect()->route("client.signin");
    }

    public function add(Product $product)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();
    }

    public function updateQty(Request $request, Product $product)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($product->id, $request->qty);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();
    }

    public function removeItem(Product $product)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;        $cart = new Cart($oldCart);
        $cart->removeItem($product->id);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);
        return back();
    }

    public function pay(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $order = new Order();
        $order->firstname = $request->firstname;
        $order->lastname = $request->lastname;
        $order->address = $request->address;
        $order->cart = serialize($cart);

        $order->save();
        Session::forget('cart');
        Session::forget('topCart');
        return redirect()->route('client.home')->with('success', 'Command validated');
    }
}
