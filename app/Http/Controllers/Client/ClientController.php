<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Models\Client;
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

    public function logout()
    {
        Session::forget('client');
        return back();
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

    public function accessAccount(Request $request)
    {
        $client = Client::where('email', $request->email)->first();
        if ($client){
            if (Hash::check($request->password, $client->password)){
                Session::put('client', $client);
                return redirect()->route("client.shop");
            }
        }
        return redirect()->route("client.signin")->with('error', 'Wrong email or password');
    }
}
