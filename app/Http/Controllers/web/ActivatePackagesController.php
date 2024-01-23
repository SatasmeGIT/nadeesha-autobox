<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivatePackagesController extends Controller
{
    public function index($id)
    {
      
        $category_id = DB::table('packages')->where('id', $id)->pluck('category_id')->first();
      
        $package_data = DB::table('packages')->find($id);

        if ($category_id == 1) { //to check free package or not(free package)
            // check free package already bought by user 
            $free_package_activate = DB::table('assign_packages')->where('customer_id', session()->get('vendor_data')->id)->first();
          
            if ($free_package_activate) {
               return redirect()->back()->with('free_package_already_activate', 'Free package can\'t be activated');


            } else {
                $assign_package = DB::table('assign_packages')->insert([
                    'customer_id' => session()->get('vendor_data')->id,
                    'package_id' => $id,
                    'package_start_date' => Carbon::now(),
                    'package_expire_date' =>  Carbon::now()->addDays($package_data->package_duration),
                    'available_ad_count' => $package_data->package_ad_count,
                    'available_top_count' => $package_data->topup_count,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                if ($assign_package) {
                    return redirect()->back()->with('free_package_success', 'Free package activated');
                } else {
                    return redirect()->back()->with('wrong', 'Something went wrong !!!');
                }
            }
        } else {
            
  
            
    

        }
    }
    
    public function activatePayedPackages($id){
        
       
        
        $packageDetails = DB::table('packages')->find($id); // get package details
        $package_check = DB::table('assign_packages')->where('customer_id', session()->get('vendor_data')->id)->first();
        
         //add data to calculate revanue
        DB::table('package_revanue')->insert([
            'user_id' => session()->get('vendor_data')->id,
            'package_id' => $id,
            'price' => $packageDetails->package_price,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        
        if ($package_check) { // if thee is any package 
       
        $updatePackage = DB::table('assign_packages')
        ->where('customer_id', session()->get('vendor_data')->id)
        ->update([
            'package_id' => $packageDetails->id,
            'package_start_date' => Carbon::now(),
            'package_expire_date' => Carbon::now()->addDays($packageDetails->package_duration),
            'available_ad_count' => DB::raw('available_ad_count + ' . $packageDetails->package_ad_count),
            'available_top_count' => DB::raw('available_top_count + ' . $packageDetails->topup_count),
            'updated_at' => Carbon::now(),
        ]);
        if($updatePackage){ // display message
             return response()->json(['code' => 200, 'msg' => $packageDetails->package_name.' added succesfully']);
        }else{
             return response()->json(['code' => 400, 'msg' => 'Something went wrong']);
        }

               
        } else {
                $assign_package = DB::table('assign_packages')->insert([
                    'customer_id' => session()->get('vendor_data')->id,
                    'package_id' => $id,
                    'package_start_date' => Carbon::now(),
                    'package_expire_date' =>  Carbon::now()->addDays($packageDetails->package_duration),
                    'available_ad_count' => $packageDetails->package_ad_count,
                    'available_top_count' => $packageDetails->topup_count,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                if ($assign_package) {
                     return response()->json(['code' => 200, 'msg' => $packageDetails->package_name.' added succesfully']);
                } else {
                     return response()->json(['code' => 400, 'msg' => 'Something went wrong']);
                }
        }
            
         
    }
    
    public function createHashPayhere($id){
           $package_data = DB::table('packages')->find($id); // package data
          
           $merchant_id = '1224415';
            $order_id = uniqid();
            $amount = $package_data->package_price;
            $merchant_secret = 'MTI5MDE4ODY0MzEwMDg0MDQ5MjI2OTUxMTEwMjkzMjMwNjE2MDk4';
            $currency = 'LKR';

            $hash = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    number_format($amount, 2, '.', '') . 
                    $currency .  
                    strtoupper(md5($merchant_secret)) 
                ) 
            );

            $payment_data = [];
            $payment_data['amount'] =$package_data->package_price;
            $payment_data['order_id'] =$order_id;
            $payment_data['items'] =$package_data->package_name;
            $payment_data['hash'] =$hash;

            $payment_data['currency'] ="LKR";
            $payment_data['delivery_country'] ="Sri lanka";
            $payment_data['delivery_city'] ="";
            $payment_data['delivery_address'] ="";
            $payment_data['country'] ="Sri lanka";
            $payment_data['city'] = "";
            $payment_data['address'] ="";
            $payment_data['phone'] ="";
            $payment_data['email'] ="";
            $payment_data['last_name'] ="";
            $payment_data['first_name'] ="";
            $payment_data['package_id'] =$id;

            $encoded_data = json_encode($payment_data);
            return $encoded_data; 
        
    }
    
    public function createHashPayhereTopads($id){
            $package_data = DB::table('top_ads_package')->find($id); // top ads package data
          
            $merchant_id = '1224415';
            $order_id = uniqid();
            $amount = $package_data->package_price;
            $merchant_secret = 'MTI5MDE4ODY0MzEwMDg0MDQ5MjI2OTUxMTEwMjkzMjMwNjE2MDk4';
            $currency = 'LKR';

            $hash = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    number_format($amount, 2, '.', '') . 
                    $currency .  
                    strtoupper(md5($merchant_secret)) 
                ) 
            );

            $payment_data = [];
            $payment_data['amount'] =$package_data->package_price;
            $payment_data['order_id'] =$order_id;
            $payment_data['items'] =$package_data->package_name;
            $payment_data['hash'] =$hash;
            $payment_data['currency'] ="LKR";
            $payment_data['delivery_country'] ="Sri lanka";
            $payment_data['delivery_city'] ="";
            $payment_data['delivery_address'] ="";
            $payment_data['country'] ="Sri lanka";
            $payment_data['city'] = "";
            $payment_data['address'] ="";
            $payment_data['phone'] ="";
            $payment_data['email'] ="";
            $payment_data['last_name'] ="";
            $payment_data['first_name'] ="";
            $payment_data['package_id'] =$id;

            $encoded_data = json_encode($payment_data);
            return $encoded_data; 
    }
    
    public function ActivateTopAdsPackage($id)
    {
        $topAdPackage = DB::table('top_ads_package')->find($id); // get top ads package data
        $package_check = DB::table('assign_packages')->where('customer_id', session()->get('vendor_data')->id)->first();
        
         //add data to calculate topup revanue
        DB::table('topup_revanue')->insert([
            'user_id' => session()->get('vendor_data')->id,
            'package_id' => $id,
            'price' => $topAdPackage->package_price,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        
        if($package_check){ // check package activated or not
            
        $updatePackage = DB::table('assign_packages')
        ->where('customer_id', session()->get('vendor_data')->id)
        ->update([
            'available_top_count' => DB::raw('available_top_count + ' . $topAdPackage->count),
            'updated_at' => Carbon::now(),
        ]);
        
        if($updatePackage) {
        return response()->json(['code' => 200, 'msg' => 'top ad package added']);
        } else {
        return response()->json(['code' => 400, 'msg' => 'Something went wrong']);
        } 
        
        }
        
        
    }
}
