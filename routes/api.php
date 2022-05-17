<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/user', [UserController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('product/')->group(function () {
    Route::group(['middleware' => ['apiJwt']], function () {
        Route::GET('index', [ProductController::class, 'index']);
        Route::GET('getbyId', [ProductController::class, 'getById']);
        Route::POST('storage', [ProductController::class, 'storage']);
        Route::POST('logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('brand/')->group(function () {
    Route::group(['middleware' => ['apiJwt']], function () {
        Route::GET('index', [BrandController::class, 'index']);
        Route::GET('getbyId', [BrandController::class, 'getById']);
        Route::POST('storage', [BrandController::class, 'storage']);
        Route::POST('logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('category/')->group(function () {
    Route::group(['middleware' => ['apiJwt']], function () {
        Route::GET('index', [CategoryController::class, 'index']);
        Route::GET('getbyId', [CategoryController::class, 'getById']);
        Route::POST('storage', [CategoryController::class, 'storage']);
        Route::POST('logout', [AuthController::class, 'logout']);
    });
});
