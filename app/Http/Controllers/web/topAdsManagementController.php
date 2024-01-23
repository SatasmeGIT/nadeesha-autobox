<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class topAdsManagementController extends Controller
{
    public function index()
    {
        $checkPackage = DB::table('assign_packages')->where('customer_id',session()->get('vendor_data')->id)->first(); // check customer purchased package or not

        $data =  DB::table('top_ads_package')->get();
        return view('Web.topAdsManagement', compact('data','checkPackage'));
    }
}
