<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Models\Client;
use App\Services\Client\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register()
    {
        return view("client.user.register");
    }

    public function signin()
    {
        return view("client.user.signin");
    }

    public function logout()
    {
        Session::forget('client');
        return redirect()->route('client.home')->with('success', 'Successful logout !');
    }

    public function createAccount(ClientRequest $request, ClientService $clientService)
    {
        try {
            $clientService->saveNewClient($request);

            return redirect()->route('client.user.signin')->with('success', 'Account created successfully, now you can sign in !');
        } catch (\Exception $e) {
            return redirect()->route('client.user.register')->with('error', 'Error : try another email');
        }
    }

    public function accessAccount(Request $request)
    {
        $client = Client::where('email', $request->email)->first();
        if ($client){
            if (Hash::check($request->password, $client->password)){
                Session::put('client', $client);
                return redirect()->route("client.shop.index")->with('success', 'Log In Successfully');
            }
        }
        return redirect()->route("client.user.signin")->with('error', 'Wrong email or password');
    }
}
