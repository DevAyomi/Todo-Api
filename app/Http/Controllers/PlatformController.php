<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePlatformRequest;
use App\Http\Requests\EditPlatformRequest;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function createPlatform(CreatePlatformRequest $request)
    {
        $formData = $request->validated();
        $platform = Platform::create($formData);
        return $this->apiResponse->created($platform, "Platform created successfully");
    }

    public function editPlatform(Request $request, $id)
    {
        $validated = $request->validate([
           'name' => ['required','string', Rule::unique('platforms')->ignore($id)],
        ]);
        $platform = Platform::where('id', $id)->first();
        $updatedPlatform = $platform->update($validated);
        return $this->apiResponse->successWithData($updatedPlatform, "Update successfull");
    }

    public function showPlatform($id)
    {
        $platformId = Platform::where('id', $id)->first();
        return $this->apiResponse->successWithData($platformId, "Platform Retrieved");
    }

    public function deletePlatform($id)
    {
        $platformId = Platform::where('id', $id)->delete();
        return $this->apiResponse->success("Platform deleted successfully");
    }
}
