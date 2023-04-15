<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Models\Product;
use App\Models\Slider;
use App\Services\Client\ClientService;

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

    public function register()
    {
        return view("client.register");
    }

    public function signin()
    {
        return view("client.signin");
    }

    public function createAccount(ClientRequest $request, ClientService $clientService)
    {
        try {
            $clientService->saveNewClient($request);

            return redirect()->route('client.signin')->with('success', 'Account created successfuly');
        } catch (\Exception $e) {
            return redirect()->route('client.register')->with('error', 'Error');
        }
    }
}
