<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlatformController;
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
        Route::post('/create-client', [AuthController::class, 'createClient']);
        Route::put('/edit-client/{id}', [ClientController::class, 'editClient']);
        Route::get('/show-client/{id}', [ClientController::class, 'showClient']);
        Route::delete('/delete-client/{id}', [ClientController::class, 'deleteClient']);
        Route::get('/all-client', [ClientController::class, 'allClient']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/clients-no', [DashboardController::class, 'allClientsNo']);
        Route::get('/campaigns-no', [DashboardController::class, 'allCampaignsNo']);
        Route::get('/platforms-no', [DashboardController::class, 'allPlatformsNo']);
        Route::post('/create-platform', [PlatformController::class, 'createPlatform']);
    });
    Route::post('/upload-image', [CloudinaryController::class, 'uploadImage']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::get('/me', [AuthController::class, 'me']);
});

//Route::get('todo-list', TodoListController::class, 'index')->name('todo-list.index');
Route::post('/login', [AuthController::class, 'login']);
