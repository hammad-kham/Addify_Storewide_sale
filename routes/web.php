<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;



Route::middleware(['verify.shopify'])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('home');


    Route::post('/select-user-tags', [SaleController::class, 'fetchUser']);

    
    Route::post('/select-product', [SaleController::class, 'fetchProduct']);

    Route::post('/select-collection', [SaleController::class, 'fetchCollection']);

    Route::post('/select-tags', [SaleController::class, 'fetchTags']);




});