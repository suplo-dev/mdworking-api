<?php

use App\Enums\PermissionEnum;
use App\Http\Controllers\Advertisement\Facebook\AddAdsFacebookController;
use App\Http\Controllers\Advertisement\Google\AddAdsGoogleController;
use App\Http\Controllers\Advertisement\Facebook\SearchAdsFacebookController;
use App\Http\Controllers\Advertisement\Google\DetailCampaignGoogleController;
use App\Http\Controllers\Advertisement\Google\SearchCampaignGoogleController;
use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\UpdateProfileController;
use App\Http\Controllers\Role\ListRoleController;
use App\Http\Controllers\User\AddUserController;
use App\Http\Controllers\User\DetailUserController;
use App\Http\Controllers\User\SearchUserController;
use App\Http\Controllers\User\UpdateUserController;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function () {
    Route::get('search', SearchUserController::class)->middleware(PermissionMiddleware::using(PermissionEnum::VIEW_USER->value));
    Route::post('add', AddUserController::class)->middleware(PermissionMiddleware::using(PermissionEnum::ADD_USER->value));
    Route::get('{user}', DetailUserController::class)->middleware(PermissionMiddleware::using(PermissionEnum::VIEW_USER->value));
    Route::put('{user}', UpdateUserController::class)->middleware(PermissionMiddleware::using(PermissionEnum::UPDATE_USER->value));
});

Route::group(['prefix' => 'advertisement'], function () {
    Route::group(['prefix' => 'facebook'], function () {
        Route::get('search', SearchAdsFacebookController::class)->middleware(PermissionMiddleware::using(PermissionEnum::VIEW_ADS_FB->value));
        Route::post('add', AddAdsFacebookController::class)->middleware(PermissionMiddleware::using(PermissionEnum::ADD_ADS_FB->value));
//        Route::get('{user}', DetailUserController::class)->middleware(PermissionMiddleware::using(PermissionEnum::VIEW_USER->value));
//        Route::put('{user}', UpdateUserController::class)->middleware(PermissionMiddleware::using(PermissionEnum::UPDATE_USER->value));
    });
    Route::group(['prefix' => 'google'], function () {
        Route::get('search', SearchCampaignGoogleController::class)->middleware(PermissionMiddleware::using(PermissionEnum::VIEW_ADS_GG->value));
        Route::post('add', AddAdsGoogleController::class)->middleware(PermissionMiddleware::using(PermissionEnum::ADD_ADS_GG->value));
    });
});

Route::group(['prefix' => 'campaign'], function () {
    Route::group(['prefix' => 'google'], function () {
        Route::get('search', SearchCampaignGoogleController::class)->middleware(PermissionMiddleware::using(PermissionEnum::VIEW_ADS_GG->value));
        Route::post('add', AddAdsGoogleController::class)->middleware(PermissionMiddleware::using(PermissionEnum::ADD_ADS_GG->value));
        Route::get('{campaignGoogle}', DetailCampaignGoogleController::class)->middleware(PermissionMiddleware::using(PermissionEnum::VIEW_ADS_GG->value));
    });
});

Route::group(['prefix' => 'role'], function () {
    Route::get('all', ListRoleController::class);
});

Route::group(['prefix' => 'profile'], function (){
    Route::get('', ProfileController::class);
    Route::put('update', UpdateProfileController::class);
    Route::put('change-password', ChangePasswordController::class);
});
