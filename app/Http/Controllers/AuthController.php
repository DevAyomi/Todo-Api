<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendCredsNotification;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
       $formData = $request->validated();
        if (!Auth::attempt($formData)) {
            return $this->apiResponse->failure("Wrong Credentials");
        }
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        $userData = [$user, $token];
        return $this->apiResponse->successWithData($userData, "Logged In");
    }


    //Create Client Method
    public function createClient(CreateClientRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'company_adress' => $request->company_address,
            'password' => Hash::make($request->password)
        ]);
  
        $user->notify(new SendCredsNotification($request->name,$request->email,$request->password));
        return $this->apiResponse->created($user, "CLient Created Successfully");
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return $this->apiResponse->success("Logged Out");
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $formData = $request->validated();
        if(!Hash::check($request->old_password, auth()->user()->password)){
          return $this->apiResponse->failure("Old password is not correct"); 
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        $this->logout();
        return $this->apiResponse->success("password changed successfully");
    }

    public function me()
    {
        $me = Auth::user();
        return $this->apiResponse->successWithData($me, "User Retrieved");
    }

    public function myCampaigns() 
    {
        $myCampaigns = Campaign::with('user')->where('user_id', Auth::id())->get();
        return $this->apiResponse->successWithData($myCampaigns, "My campaigns retrieved");
    }

}
