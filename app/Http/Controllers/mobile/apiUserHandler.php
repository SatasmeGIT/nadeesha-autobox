<?php

namespace App\Http\Controllers\mobile;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Storage;

class apiUserHandler extends Controller
{
    public function getUserData(Request $request)
    {
        $email = $request->input('email');
        $user = DB::table('users')
            ->where(DB::raw('lower(email)'), strtolower($email))
            ->first();
        if ($user) {
            return response()->json([
                'stat' => 'ok',
                'user' => $user,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function updateProfileImage(Request $request)
    {
        try {

            $current_img_path = DB::table('users')
                ->where('id', $request->uid)
                ->pluck('Profile_Image')->first();
            // delete current image 
            $image_path = public_path("assets/myCustomThings/vehicleTypes/{$current_img_path}");
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            //Image Upload Process
            $image_1 = time() . rand(1, 1000) . '.' . $request->profile_img->extension();
            $image = Image::make($request->file('profile_img'))->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            }); // Create an instance of the image
            $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_1}"));

            $result = DB::table('users')->where('id', $request->uid)->update([
                'Profile_Image' => "$image_1",
                'updated_at' => Carbon::now(),
            ]);
            //if ($image_1) {
            if ($result) {
                return response()->json(['stat' => 'ok', 'path' => "$image_1", "prev_img" =>  $current_img_path]);
            } else {
                return response()->json(['stat' => 'error', 'msg' => 'Error saving image', "prev_img" => $current_img_path]);
            }
        } catch (\Throwable $th) {
            return response()->json(['stat' => 'error', 'msg' => $th->getMessage(), "prev_img" =>  $current_img_path]);
        }
        //} else {
        //    return response()->json(['stat' => 'false', 'msg' => "Something went wrong."]);
        //}
    }

    public function userProfileDataUpdate(Request $request)
    {
        $email = $request->input('email');
        $affected = DB::table('users')
            ->where('email', $email)
            ->update(
                [
                    'updated_at' => Carbon::now(),
                    'First_Name' => $request->input('firstName'),
                    'Last_Name' => $request->input('lastName'),
                    'phone' => $request->input('phoneNo'),
                    'district' => $request->input('district'),
                    'city' => $request->input('city'),
                ]
            );
        if ($affected) {
            return response()->json(['stat' => 'ok']);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function loadUserAds(Request $request)
    {
        $user_id = $request->input('user_id');
        $adsData = DB::table('ads')
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->where('ads.ads_customers_id', $user_id)
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id', 'ads.status')
            ->paginate(6);
        if ($adsData) {
            return response()->json([
                'stat' => 'ok',
                'ads' => $adsData,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function updateSocialLinks(Request $request)
    {
        $email = $request->input('email');
        $affected = DB::table('users')
            ->where('email', $email)
            ->update(
                [
                    'updated_at' => Carbon::now(),
                    'Fb_link' => $request->input('fb'),
                    'Twitter_link' => $request->input('twitter'),
                    'Linkedin_link' => $request->input('linkedin'),
                    'Youtube_link' => $request->input('yt'),
                ]
            );
        if ($affected) {
            return response()->json(['stat' => 'ok']);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function claimFreeAdPack(Request $request)
    {
        $uid = $request->input('uid');
        $id = $request->input('pid');
        $user = DB::table('users')
            ->where('id', $uid)
            ->update(
                [
                    'is_free_package_active' => '1'
                ]
            );      
        $package_data = DB::table('packages')->find($id);
            // check free package already bought by user 
        $free_package_activate = DB::table('assign_packages')->where('customer_id', $uid)->first();
        $assign_package = DB::table('assign_packages')->insert([
            'customer_id' => $uid,
            'package_id' => $id,
            'package_start_date' => Carbon::now(),
            'package_expire_date' =>  Carbon::now()->addDays($package_data->package_duration),
            'available_ad_count' => $package_data->package_ad_count,
            'available_top_count' => $package_data->topup_count,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if ($assign_package && $user) {
            return response()->json([
                'stat' => 'ok',
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }
}
