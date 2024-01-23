<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PackageController extends Controller
{

    public function getAllAdPackages(Request $request)
    {
        //$uid = $request->input('user_id');
        $packages = DB::table('packages')
            ->where('status', 1)
            ->get();
        if ($packages) {
            return response()->json([
                'stat' => 'ok',
                'packages' => $packages,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function getAllTopAdPackages(Request $request)
    {
        //$uid = $request->input('user_id');
        $packages = DB::table('top_ads_package')
            ->where('status', 1)
            ->get();
        if ($packages) {
            return response()->json([
                'stat' => 'ok',
                'packages' => $packages,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function getMyAdPackage(Request $request)
    {
        $uid = $request->input('uid');
        $myPack = DB::table('assign_packages')
            ->join('packages', 'packages.id', '=', 'assign_packages.package_id')
            ->where('assign_packages.status', 1)
            ->where('assign_packages.customer_id', $uid)
            ->select('packages.package_name', 'assign_packages.available_ad_count', 'assign_packages.available_top_count','assign_packages.package_start_date'
            ,'assign_packages.package_expire_date','packages.image_count')
            ->first();
        if ($myPack) {
            return response()->json([
                'stat' => 'ok',
                'mypack' => $myPack,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function buyPaidAdPackage(Request $request)
    {
        $uid = $request->input('uid');
        $id = $request->input('pid');

        $packageDetails = DB::table('packages')->find($id); // get package details
        $package_check = DB::table('assign_packages')->where('customer_id', $uid)->first();

        //add data to calculate revanue
        DB::table('package_revanue')->insert([
            'user_id' => $uid,
            'package_id' => $id,
            'price' => $packageDetails->package_price,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if ($package_check) { // if thee is any package 

            $updatePackage = DB::table('assign_packages')
                ->where('customer_id', $uid)
                ->update([
                    'package_id' => $packageDetails->id,
                    'package_start_date' => Carbon::now(),
                    'package_expire_date' => Carbon::now()->addDays($packageDetails->package_duration),
                    'available_ad_count' => DB::raw('available_ad_count + ' . $packageDetails->package_ad_count),
                    'available_top_count' => DB::raw('available_top_count + ' . $packageDetails->topup_count),
                    'updated_at' => Carbon::now(),
                ]);
            if ($updatePackage) { // display message
                return response()->json([
                    'stat' => 'ok',
                ]);
            } else {
                return response()->json([
                    'stat' => 'err',
                ]);
            }
        } else {
            $assign_package = DB::table('assign_packages')->insert([
                'customer_id' => $uid,
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
                return response()->json([
                    'stat' => 'ok',
                ]);
            } else {
                return response()->json([
                    'stat' => 'err',
                ]);
            }
        }
    }

    public function buyTopPaidAdPackage(Request $request)
    {

        $uid = $request->input('uid');
        $id = $request->input('pid');

        $packageDetails = DB::table('top_ads_package')->find($id); // get package details

        //add data to calculate revanue
        DB::table('topup_revanue')->insert([
            'user_id' => $uid,
            'package_id' => $id,
            'price' => $packageDetails->package_price,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

            $updatePackage = DB::table('assign_packages')
                ->where('customer_id', $uid)
                ->update([
                    'available_top_count' => DB::raw('available_top_count + ' . $packageDetails->count),
                    'updated_at' => Carbon::now(),
                ]);
            if ($updatePackage) { // display message
                return response()->json([
                    'stat' => 'ok',
                ]);
            } else {
                return response()->json([
                    'stat' => 'err',
                ]);
            }
    }

}
