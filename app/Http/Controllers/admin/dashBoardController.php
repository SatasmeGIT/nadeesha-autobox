<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class dashBoardController extends Controller
{
    public function index(){
        
        //get package reavane list
        // $package_revanue_list = DB::table('package_revanue')
        //     ->join('packages', 'package_revanue.package_id', '=', 'packages.id')
        //     ->join('users', 'package_revanue.user_id', '=', 'users.id')
        //     ->select('users.*', 'packages.*', 'package_revanue.*')
        //     ->get();
            
         $monthlyRevenuePackage = DB::table('package_revanue') // get revanue in package revanue monthy
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(price) as total'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->toArray();
        
        // Fill in missing months with 0
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($monthlyRevenuePackage[$i])) {
                $monthlyRevenuePackage[$i] = 0;
            }
        }
        
        ksort($monthlyRevenuePackage); // Sort the array by keys (months) in ascending order
        
        
          $monthlyRevenueTopup = DB::table('topup_revanue') // get revanue in topup package revanue monthy
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(price) as total'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->toArray();
        
        // Fill in missing months with 0
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($monthlyRevenueTopup[$i])) {
                $monthlyRevenueTopup[$i] = 0;
            }
        }
        
        ksort($monthlyRevenueTopup); // Sort the array by keys (months) in ascending order
        

        $package_total = DB::table('package_revanue')->sum('price'); //get package total
        $currentMonthRevenuePackage = DB::table('package_revanue')
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('price');
    
        $topup_total = DB::table('topup_revanue')->sum('price'); //get package total
        $currentMonthRevenueTopups = DB::table('topup_revanue')
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('price');
        
        $ads_count = DB::table('ads')->where('status',1)->count(); // ads count
        
        $users_count = DB::table('users')->where('isAdmin',0)->where('status',1)->count(); // ads count
        
        $users_latest = DB::table('users')
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        
        return view('Admin.index',compact('package_total','currentMonthRevenuePackage','topup_total','currentMonthRevenueTopups','ads_count','users_count','users_latest','monthlyRevenueTopup','monthlyRevenuePackage'));
    }
    
    public function packageRevanueTable(){
        
      $data = DB::table('package_revanue')
            ->join('packages', 'package_revanue.package_id', '=', 'packages.id')
            ->join('users', 'package_revanue.user_id', '=', 'users.id')
            ->select('users.*', 'packages.*', 'package_revanue.*')
            ->get();
        
      return datatables()->of($data)
      ->addIndexColumn()
      ->make(true);
        
    }
    
      public function packageTopupTable(){
        
      $data = DB::table('topup_revanue')
            ->join('top_ads_package', 'topup_revanue.package_id', '=', 'top_ads_package.id')
            ->join('users', 'topup_revanue.user_id', '=', 'users.id')
            ->select('users.*', 'top_ads_package.*', 'topup_revanue.*')
            ->get();
        
      return datatables()->of($data)
      ->addIndexColumn()
      ->make(true);
        
    }
}
