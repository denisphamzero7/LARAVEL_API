<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;





Route::get('products',function(){
    return "api products";
});

Route::prefix('auth')->name('auth.')->group(function(){

});

Route::prefix('user')->name('user.')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::post('/',[UserController::class,'store'])->name('store');
    Route::get('/{user}',[UserController::class,'show'])->name('show');
    Route::put('/{user}',[UserController::class,'update'])->name('update-put');
    Route::patch('/{user}',[UserController::class,'update'])->name('update-patch');
    Route::delete('/{user}',[UserController::class,'destroy'])->name('destroy');
});
