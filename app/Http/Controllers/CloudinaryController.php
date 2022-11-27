<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Models\User;

class CloudinaryController extends Controller
{
   public function uploadImage(ImageRequest $request)
   {
    $uploadedFileUrl = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
    User::whereId(auth()->user()->id)->update([
        'profile_picture' => $uploadedFileUrl
    ]);
    return $this->apiResponse->success("Profile pictureupdated successfully");
   }

}
