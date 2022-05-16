<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

    Route::GET('product/index',[ProductController::class,'index']);
    Route::GET('product/getbyId',[ProductController::class,'getById']);
    Route::POST('product/storage',[ProductController::class,'storage']);


    Route::GET('brand/index',[BrandController::class,'index']);
    Route::GET('brand/getbyId',[BrandController::class,'getById']);
    Route::POST('brand/storage',[BrandController::class,'storage']);

    Route::GET('category/index',[CategoryController ::class,'index']);
    Route::GET('category/getbyId',[CategoryController::class,'getById']);
    Route::POST('category/storage',[CategoryController::class,'storage']);


// Route::group(['brand'], function(){   
//     Route::GET('index',[BrandtController::class,'index']);
//     Route::GET('getbyId',[BrandtController::class,'getById']);
//     Route::POST('storage',[BrandtController::class,'storage']);
// });

// Route::group(['category'], function(){   
//     Route::GET('index',[CategoryController::class,'index']);
//     Route::GET('getbyId',[CategoryController::class,'getById']);
//     Route::POST('storage',[CategoryController::class,'storage']);
// });



