<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController ;
use App\Http\Controllers\Api\AuthorController;






Route::get('products',function(){
    return "api products";
});

Route::prefix('auth')->name('auth.')->group(function(){
Route::post('/login',[AuthorController::class,'login']);
});

Route::prefix('user')->name('user.')->group(function(){
    Route::get('/',function(){
        return "Danh sách user";
    });
});
