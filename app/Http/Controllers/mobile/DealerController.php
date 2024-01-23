<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Storage;

class DealerController extends Controller
{
    public function becomeADealer(Request $request)
    {
        $image_1 = time() . rand(1, 1000) . '.' . $request->company_logo->extension();
        $image = Image::make($request->file('company_logo'))->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        }); // Create an instance of the image
        $image->save(public_path("assets/myCustomThings/dealer/{$image_1}"));

        $uid = $request->input('uid');
        $id = DB::table('dealer')->insertGetId(
            [
                'user_id' => $uid,
                'company_logo' => "{$image_1}",
                'Company_Name' => $request->input('company_name'),
                'address' => $request->input('address'),
                'google_location' => $request->input('google_location'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        $affected = DB::table('users')
            ->where('id', $uid)
            ->update(
                [
                    'updated_at' => Carbon::now(),
                    'cus_role_id' => 2,
                ]
            );

        if ($id) {
            if ($affected) {
                return response()->json(['stat' => 'ok', "id" => $id]);
            } else {
                return response()->json(['stat' => 'error']);
            }
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function updateDealer(Request $request)
    {
        $uid = $request->input('uid');
        $id = DB::table('dealer')
            ->where('user_id', $uid)
            ->update(
                [
                    'Company_Name' => $request->input('company_name'),
                    'address' => $request->input('address'),
                    'google_location' => $request->input('google_location'),
                    'updated_at' => Carbon::now(),
                ]
            );

        if ($id) {
            return response()->json(['stat' => 'ok']);
        } else {
            return response()->json(['stat' => 'error', 'data' => 'Error saving data']);
        }
    }

    public function updateDealerLogoImage(Request $request)
    {
        try {
            $current_img_path = DB::table('dealer')
                ->where('user_id', $request->uid)
                ->pluck('company_logo')->first();
            // delete current image 
            $image_path = public_path("assets/myCustomThings/dealer/{$current_img_path}");
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            //Image Upload Process
            $image_1 = time() . rand(1, 1000) . '.' . $request->dealer_logo->extension();
            $image = Image::make($request->file('dealer_logo'))->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            }); // Create an instance of the image
            $image->save(public_path("assets/myCustomThings/dealer/{$image_1}"));

            $result = DB::table('dealer')->where('user_id', $request->uid)->update([
                'company_logo' => "$image_1",
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

    public function getDealerData(Request $request)
    {
        $uid = $request->input('user_id');
        $user = DB::table('dealer')
            ->where('user_id', $uid)
            ->first();
        if ($user) {
            return response()->json([
                'stat' => 'ok',
                'dealer' => $user,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function getOtherUserData(Request $request)
    {
        $uid = $request->input('user_id');
        $user = DB::table('users')
            ->where('id', $uid)
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

}
