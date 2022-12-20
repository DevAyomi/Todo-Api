<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Http\Requests\CreateCampaignReuest;
use App\Http\Requests\UpdateCampaignRequest;

class CampaignController extends Controller
{
    public function createCampaign(CreateCampaignReuest $request)
    {
        $formData = $request->validated();
        $campaign = Campaign::create($formData);
        return $this->apiResponse->created($campaign, "Campaign created successfully");
    }
    public function allCampaigns()
    {
        $allCampaigns = Campaign::with('user')->latest()->paginate(4);
        return $this->apiResponse->successWithData($allCampaigns, "All campaigns retrieved");
    }

    public function showCampaign($id)
    {
        $campaign = Campaign::with('user')->where('id', $id)->first();
        return $this->apiResponse->successWithData($campaign, "Campaign retrieved");
    }

    public function updateCampaign(UpdateCampaignRequest $request, $id)
    {
        $formData = $request->validated();
        $campaign = Campaign::where("id", $id)->first();
        $campaign->update($formData);
        return $this->apiResponse->success("Updated successfully");
    }

    public function deleteCampaign($id)
    {
        $campaign = Campaign::where("id", $id)->delete();
        return $this->apiResponse->success("Deleted successfully");
    }
}
