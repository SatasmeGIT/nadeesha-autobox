<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mobile\apiAuthController;
use App\Http\Controllers\mobile\apiUserHandler;
use App\Http\Controllers\mobile\DealerController;
use App\Http\Controllers\mobile\PackageController;
use App\Http\Controllers\mobile\AdvertisementController;
use App\Http\Controllers\mobile\AdminDataController;
use App\Http\Controllers\mobile\GarageController;
use App\Http\Controllers\mobile\GlobalDataController;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/mobile/userExists', [apiAuthController::class, 'isUserExists']);
Route::post('/mobile/login', [apiAuthController::class, 'userLog']);
Route::post('/mobile/signup', [apiAuthController::class, 'userRegister']);

Route::post('/mobile/getUserData', [apiUserHandler::class, 'getUserData']);
Route::post('/mobile/userProfileDataUpdate', [apiUserHandler::class, 'userProfileDataUpdate']);
Route::post('/mobile/updateSocialLinks', [apiUserHandler::class, 'updateSocialLinks']);
Route::post('/mobile/updateProfileImage', [apiUserHandler::class, 'updateProfileImage']);
Route::post('/mobile/claimFreeAdPack', [apiUserHandler::class, 'claimFreeAdPack']);
Route::get('/mobile/loadUserAds', [apiUserHandler::class, 'loadUserAds']);

Route::post('/mobile/becomeADealer', [DealerController::class, 'becomeADealer']);
Route::get('/mobile/getDealerData', [DealerController::class, 'getDealerData']);
Route::get('/mobile/getOtherUserData', [DealerController::class, 'getOtherUserData']);
Route::post('/mobile/updateDealer', [DealerController::class, 'updateDealer']);
Route::post('/mobile/updateDealerLogoImage', [DealerController::class, 'updateDealerLogoImage']);

Route::get('/mobile/getAllAdPackages', [PackageController::class, 'getAllAdPackages']);
Route::get('/mobile/getAllTopAdPackages', [PackageController::class, 'getAllTopAdPackages']);
Route::post('/mobile/buyPaidAdPackage', [PackageController::class, 'buyPaidAdPackage']);
Route::get('/mobile/getMyAdPackage', [PackageController::class, 'getMyAdPackage']);
Route::post('/mobile/buyTopPaidAdPackage', [PackageController::class, 'buyTopPaidAdPackage']);

Route::post('/mobile/getRecentAds', [AdvertisementController::class, 'getRecentAds']);
Route::get('/mobile/getFilteredPaginatedAds', [AdvertisementController::class, 'getFilteredPaginatedAds']);
Route::post('/mobile/createAd', [AdvertisementController::class, 'createAd']);
Route::post('/mobile/updateAd', [AdvertisementController::class, 'updateAd']);
Route::post('/mobile/disableAd', [AdvertisementController::class, 'disableAd']);
Route::post('/mobile/PlaceAnInquiry', [AdvertisementController::class, 'PlaceAnInquiry']);
Route::post('/mobile/getAdData', [AdvertisementController::class, 'getAdData']);
Route::post('/mobile/updateAdViewCountByOne', [AdvertisementController::class, 'updateAdViewCountByOne']);
Route::post('/mobile/searchAdsThroughText', [AdvertisementController::class, 'searchAdsThroughText']);
Route::get('/mobile/getAllInquiry', [AdvertisementController::class, 'getAllInquiry']);
Route::get('/mobile/getMyInquiry', [AdvertisementController::class, 'getMyInquiry']);
Route::post('/mobile/deleteInq', [AdvertisementController::class, 'deleteInq']);

Route::post('/mobile/getBrandModel', [AdminDataController::class, 'getBrandModel']);
Route::post('/mobile/getDistricts', [AdminDataController::class, 'getDistricts']);
Route::post('/mobile/getCities', [AdminDataController::class, 'getCities']);
Route::post('/mobile/getVehicleTypes', [AdminDataController::class, 'getVehicleTypes']);

Route::get('/mobile/getFilteredPaginatedGarages', [GarageController::class, 'getFilteredPaginatedGarages']);
Route::post('/mobile/getGarageData', [GarageController::class, 'getGarageData']);
Route::get('/mobile/getUserGarages', [GarageController::class, 'getUserGarages']);
Route::post('/mobile/createGarage', [GarageController::class, 'createGarage']);

Route::get('/mobile/getBannerAds', [GlobalDataController::class, 'getBannerAds']);
