<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\EditClientRequest;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{   
    public function clients()
    {
        $allClient = User::where('userType', 'Client')->get();
        return $this->apiResponse->successWithData($allClient, "List of all Clients");
    }
    public function allClient()
    {
        $allClient = User::where('userType', 'Client')->latest()->paginate(4);
        return $this->apiResponse->successWithData($allClient, "List of all Clients");
    }

    public function editClient(Request $request, $id)
    {
        $validated = $request->validate([
           'email' => ['nullable','email','string', Rule::unique('users')->ignore($id)],
           'password' => 'nullable',
           'name' => 'nullable|string|max:60',
           'company_name' => ['nullable','string', Rule::unique('users')->ignore($id)],
           'company_address' => 'nullable|string',
        ]);

        $client = User::where('id', $id)->first();
        $updatedClient = $client->update($validated);
        return $this->apiResponse->successWithData($updatedClient, "Update successfull");
    }

    public function showClient($id)
    {
        $clientId = User::where('id', $id)->first();
        return $this->apiResponse->successWithData($clientId, "Client Retrieved");
    }

    public function deleteClient($id)
    {
        $clientId = User::where('id', $id)->delete();
        return $this->apiResponse->success("Client deleted successfully");
    }

}
