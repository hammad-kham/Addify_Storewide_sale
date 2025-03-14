<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function generalSettings(){
        return view('sale_pages.General_settings');
    }

    public function notificationSettings(){
        return view('sale_pages.notification_settings');
    }

    public function saleBasedOnRole(){
        return view('sale_pages.sale_base_on_role');
    }

    public function saleReports(){
        return view('sale_pages.sales_reports');
    }
}
