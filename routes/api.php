<?php

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

Route::post('register',[App\Http\Controllers\AuthController::class,'register']);
Route::post('login',[App\Http\Controllers\AuthController::class,'login']);

<<<<<<< HEAD
Route::middleware('auth:api')->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('follow',[\App\Http\Controllers\UserController::class,'follow']);
    Route::get('followers',[\App\Http\Controllers\UserController::class,'followers']);
=======
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
>>>>>>> 71dc90dd39f5c1c8aaee7aee900ec5c95be8f6d2
});
