<?php

namespace App\Services\Client;

use App\Http\Requests\Client\ClientRequest;
use App\Models\Client;
use App\Services\Admin\AdminService;
use Illuminate\Support\Facades\Hash;

class ClientService extends AdminService
{
    public function saveNewClient(ClientRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        return $this->create(Client::class, $data);
    }


    public function updateClient(Client $client, ClientRequest $request)
    {
        return $this->update($client, $request->validated());
    }
}
