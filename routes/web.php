<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;



Route::middleware(['verify.shopify'])->group(function(){
    Route::get('/', [SaleController::class,'index'])->name('home');


    Route::post('/select-user-tags', [SaleController::class, 'fetchUserTags']);

    
    Route::post('/select-product', [SaleController::class, 'fetchProduct']);

    Route::post('/select-collection', [SaleController::class, 'fetchCollection']);

    Route::post('/select-tags', [SaleController::class, 'fetchTags']);


    //general settings

    Route::post('is-sale-enable',[SaleController::class,'isSaleEnable']);


    Route::post('role-restriction-form',[SaleController::class,'storeRoleRestrictionForm']);

    Route::post('notification-setting',[SaleController::class,'notiificationSettings']);


});