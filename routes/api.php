<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Client\Request;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products', ProductController::class);

Route::apiResource('categories', CategoryController::class);

Route::get('categories/{category}/products', [CategoryController::class, 'products']);

Route::post('register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login']);
