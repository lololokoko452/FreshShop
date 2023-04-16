<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Services\Client\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status', true)->get();
        $products = Product::all();
        $categories = Category::all();
        return view("client.home", compact("sliders", "products", "categories"));
    }

    public function shop()
    {
        $products = Product::all();
        return view("client.shop", compact("products"));
    }

    public function register()
    {
        return view("client.register");
    }

    public function signin()
    {
        return view("client.signin");
    }

    public function logout()
    {
        Session::forget('client');
        return back();
    }

    public function orders($clientId)
    {
        $client = Client::where('id', $clientId)->first();
        $orders = $client->orders;
        $orders->transform(function ($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('client.orders', compact("client", "orders"));
    }

    public function createAccount(ClientRequest $request, ClientService $clientService)
    {
        try {
            $clientService->saveNewClient($request);

            return redirect()->route('client.signin')->with('success', 'Account created successfully, now you can sign in !');
        } catch (\Exception $e) {
            return redirect()->route('client.register')->with('error', 'Error : try another email');
        }
    }

    public function accessAccount(Request $request)
    {
        $client = Client::where('email', $request->email)->first();
        if ($client){
            if (Hash::check($request->password, $client->password)){
                Session::put('client', $client);
                return redirect()->route("client.shop")->with('success', 'Log In Successfully');
            }
        }
        return redirect()->route("client.signin")->with('error', 'Wrong email or password');
    }

    public function show(Order $order){

        Session::put('id', $order->id);

        try{
            $pdf = \App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
            $pdf->loadHTML($this->convert_orders_data_to_html());

            return $pdf->stream();
        }
        catch(Exception $e){
            return redirect('/admin/orders')->with('error', $e->getMessage());
        }

    }

    public function convert_orders_data_to_html(){

        $orders = Order::where('id',Session::get('id'))->get();

        foreach($orders as $order){
            $nom = $order->firstname . ' ' . $order->lastname;
            $adresse = $order->address;
            $date = $order->created_at;
        }

        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);

            return $order;
        });

        $output = '<link rel="stylesheet" href="frontend/css/style1.css">
            <table class="table">
                <thead class="thead">
                    <tr class="text-left">
                        <th>Client Name : '.$nom.'<br> Client Address : '.$adresse.' <br> Date : '.$date.'</th>
                    </tr>
                </thead>
            </table>
            <table class="table">
                <thead class="thead-primary">
                    <tr class="text-center">
                        <th>Image</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>';
        foreach($orders as $order){

            foreach($order->cart->items as $item){

                $output .= '<tr class="text-center">
                                        <td class="image-prod"><img src="storage/product_images/'.$item['product_image'].'" alt="" style = "height: 80px; width: 80px;"></td>
                                        <td class="product-name">
                                            <h3>'.$item['product_name'].'</h3>
                                        </td>
                                        <td class="price">$ '.$item['product_price'].'</td>
                                        <td class="qty">'.$item['qty'].'</td>
                                        <td class="total">$ '.$item['product_price']*$item['qty'].'</td>
                                    </tr><!-- END TR-->
                                    </tbody>';

            }

            $totalPrice = $order->cart->totalPrice;

        }

        $output .='</table>';

        $output .='<table class="table">
                            <thead class="thead">
                                <tr class="text-center">
                                        <th>Total</th>
                                        <th>$ '.$totalPrice.'</th>
                                </tr>
                            </thead>
                        </table>';


        return $output;

    }
}
