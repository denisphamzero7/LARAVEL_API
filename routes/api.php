<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;





Route::get('products',function(){
    return "api products";
});

Route::prefix('auth')->name('auth.')->group(function(){

});

Route::middleware('auth:sanctum')->prefix('user')->name('user.')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::post('/',[UserController::class,'store'])->name('store');
    Route::get('/{user}',[UserController::class,'show'])->name('show');
    Route::put('/{user}',[UserController::class,'update'])->name('update-put');
    Route::patch('/{user}',[UserController::class,'update'])->name('update-patch');
    Route::delete('/{user}',[UserController::class,'destroy'])->name('destroy');
});
Route::post('login',[AuthController::class,'login'])->name('auth.login');
Route::get('token',[AuthController::class,'getToken'])->middleware('auth:sanctum')->name('auth.token');
