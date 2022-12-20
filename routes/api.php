<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\CampaignController;
use App\Http\Middleware\CheckUserType;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware([CheckUserType::class])->group(function () {

        //Clients URL'S
        Route::post('/create-client', [AuthController::class, 'createClient']);
        Route::put('/edit-client/{id}', [ClientController::class, 'editClient']);
        Route::get('/show-client/{id}', [ClientController::class, 'showClient']);
        Route::delete('/delete-client/{id}', [ClientController::class, 'deleteClient']);
        Route::get('/all-client', [ClientController::class, 'allClient']);
        Route::get('/clients', [ClientController::class, 'clients']);
        Route::get('/clients-no', [DashboardController::class, 'allClientsNo']);
       

        //Platforms URL'S
        Route::get('/platforms-no', [DashboardController::class, 'allPlatformsNo']);
        Route::post('/create-platform', [PlatformController::class, 'createPlatform']);
        Route::get('/all-platform', [PlatformController::class, 'allPlatforms']);
        Route::get('/platforms', [PlatformController::class, 'platforms']);
        Route::get('/show-platform/{id}', [PlatformController::class, 'showPlatform']);
        Route::delete('/delete-platform/{id}', [PlatformController::class, 'deletePlatform']);
        Route::put('/edit-platform/{id}', [PlatformController::class, 'editPlatform']);

        //Campaignss URL'S
        Route::get('/campaigns-no', [DashboardController::class, 'allCampaignsNo']);
        Route::post('/create-campaign', [CampaignController::class, 'createCampaign']);
        Route::get('/all-campaigns', [CampaignController::class, 'allCampaigns']);
        Route::put('/edit-campaign/{id}', [CampaignController::class, 'updateCampaign']);
        Route::delete('/delete-campaign/{id}', [CampaignController::class, 'deleteCampaign']);
    });
    Route::post('/upload-image', [CloudinaryController::class, 'uploadImage']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/my-campaigns', [AuthController::class, 'myCampaigns']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/show-campaign/{id}', [CampaignController::class, 'showCampaign']);
});

//Route::get('todo-list', TodoListController::class, 'index')->name('todo-list.index');
Route::post('/login', [AuthController::class, 'login']);
