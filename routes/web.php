<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;



Route::middleware(['verify.shopify'])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('general-settings',[SaleController::class,'generalSettings'])->name('generalSettings');

    Route::get('role-based-sale',[SaleController::class,'notificationSettings'])->name('notificationSettings');

    Route::get('notification-settings',[SaleController::class,'saleBasedOnRole'])->name('saleBasedOnRole');

    Route::get('sale-reports',[SaleController::class,'saleReports'])->name('saleReports');



});