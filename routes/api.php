<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AppItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::middleware('api')->group(function () {
    Route::get('fetchAppData', [AppItemController::class, 'fetchAppData']);

});




Route::post('login',[UserController::class,'login']);
Route::post('post_add_appItem',[AppItemController::class,'post_add_appItem']);





