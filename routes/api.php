<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\HelperController;
use App\Http\Controllers\Api\V1\CategoryController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(array('middleware'=>['log_after_request']), function(){

    Route::group(['prefix' => 'v1/user'],function() {
        Route::post('login',[LoginController::class, 'socialLogin']);
        Route::get('getCategory',[CategoryController::class, 'getCategory']);
        Route::group(['middleware' => ['auth:api']], function() {
            Route::post('profile-step-2',[
                LoginController::class, 'Step2User'
            ]);
            Route::post('logout',[
                LoginController::class, 'postUserLogout'
            ]);
        });
    });

});
