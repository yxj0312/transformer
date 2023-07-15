<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ProductController;
use App\Http\Resources\ProductResource;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// // Route::get('/products', [ProductController::class, 'apiIndex'])->name('api.product.index');

// Route::apiResource('products', ProductApiController::class);

// 用户注册
Route::post('/register', [AuthController::class, 'register']);

// 用户登录
Route::post('/login', [AuthController::class, 'login']);