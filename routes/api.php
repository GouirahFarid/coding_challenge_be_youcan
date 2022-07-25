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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::prefix('categories')->group(function (){
     Route::post('',[\App\Http\Controllers\CategoryController::class,'create']);
     Route::get('',[\App\Http\Controllers\CategoryController::class,'all']);
     Route::delete('/{categoryId}',[\App\Http\Controllers\CategoryController::class,'delete']);
 });
Route::prefix('products')->group(function (){
    Route::post('',[\App\Http\Controllers\ProductController::class,'create']);
    Route::get('',[\App\Http\Controllers\ProductController::class,'all']);
    Route::delete('/{productId}',[\App\Http\Controllers\ProductController::class,'delete']);
});
