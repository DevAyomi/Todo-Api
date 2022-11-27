<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Platform;

class DashboardController extends Controller
{
    public function allClientsNo()
    {
        $allClients = User::where('userType', 'Client')->count();
        return $this->apiResponse->successWithData($allClients, "All clients no");
    }

    public function allCampaignsNo()
    {
        $allCampaigns = Campaign::all()->count();
        return $this->apiResponse->successWithData($allCampaigns, "All campaigns no");
    }

    public function allPlatformsNo()
    {
        $allPlatforms = Platform::all()->count();
        return $this->apiResponse->successWithData($allPlatforms, "All platforms no");
    }
}
