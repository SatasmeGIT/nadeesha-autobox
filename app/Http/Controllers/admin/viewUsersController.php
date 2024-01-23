<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Database\QueryException;

class viewUsersController extends Controller
{
    public function index()
    {
        return view('Admin.users');
    }

    public function test()
    {
        $data = DB::table('users')->get();
        return response()->json(['data' => $data]);
    }

    public function getData()
    {
        $data = DB::table('users')->orderBy('id', 'desc')->where('isAdmin', 0)->get();

        return datatables()->of($data)
            ->addIndexColumn()

            ->addColumn('deatils', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="more m-1"> <i class="fa-solid fa-circle-info " style="color: #1ebe46; font-size: 26px;"></i> </a>';
                $btn = $btn. '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit m-1">  <i class="fa-solid fa-pen-to-square" style="color: #1ebe46; font-size: 26px;"></i> </a>';
                return $btn;
            })
            ->addColumn('image', function ($data) {
                if (!empty($data->Profile_Image)) {
                    $url = asset("assets/myCustomThings/vehicleTypes/$data->Profile_Image");
                } else {
                    $url = "https://i.ibb.co/xS0GMYT/profile.png";
                }
                return '<img style="  width:55px !important; height:55px !important; object-fit:contain !important;" src=' . $url . ' border="0"  class="img-rounded" align="center" />';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge badge-pill badge-soft-success">Active</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Deactive</span>';
                }
                return $status;
            })
            ->addColumn('position', function ($data) {
                if ($data->cus_role_id  == 2) {
                    $status = '<span class="badge badge-pill badge-soft-success">Dealer</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Vendor</span>';
                }
                return $status;
            })
            ->rawColumns(['image', 'status', 'position', 'deatils'])
            ->make(true);
    }

    public function more($id)
    {
     
         $monthlyRevenuePackage = DB::table('package_revanue') // get revanue in package revanue monthy
            ->where('user_id',$id)
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
            ->where('user_id',$id)
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
        
        //end stat data
        
        $final_spend_package = DB::table('package_revanue')
        ->where('user_id', $id)
        ->sum('price');
        
        $final_spend_topup = DB::table('topup_revanue')
        ->where('user_id', $id)
        ->sum('price');

        $my_ads = DB::table('ads') //get vendor ads
            ->where('ads_customers_id', $id)
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.ad_expire_date', 'ads.top_ad_expire_date', 'ads.is_top_id', 'ads.status', 'ads.adminStatus')
            ->get();

        $userDetailed = DB::table('users')
            ->where('users.id', $id)
            ->leftJoin('assign_packages', 'assign_packages.customer_id', '=', 'users.id')
            ->select('users.*', 'assign_packages.*')
            ->selectRaw('users.created_at AS user_joined')
            ->first(); //user details
            
            // dd($userDetailed);
            

        $package_name = DB::table('packages')->where('id', $userDetailed->package_id)->pluck('package_name')->first(); //package details

        return view('Admin.userDetailed', compact('userDetailed', 'package_name', 'my_ads','final_spend_topup','final_spend_package','monthlyRevenueTopup','monthlyRevenuePackage'));
    }

    public function delete($id)
    {

        // delete images start 
        $exist_images = DB::table('ads_images')->where('ads_id', $id)->get();
        foreach ($exist_images  as $image) {
            $image_path = public_path('assets/myCustomThings/vehicleTypes/' . $image->name);
            if (File::exists($image_path)) {
                File::delete($image_path);
                //1690282460161.jpg  1690282462445.jpg  1690282463557.jpg
            }
        }

        // Perform the delete operation
        $deleted = DB::table('ads')->where('id', '=', $id)->delete();



        // delete images end 

        // Check if the delete was successful
        if ($deleted) {
            // If successful, redirect back with a success message
            return redirect()->back()->with('success', 'Ad deleted successfully!');
        } else {
            // If unsuccessful, redirect back with an error message
            return redirect()->back()->with('error', 'Failed to delete the ad.');
        }
    }

    public function changeStatus($id)
    {
        $admin_status = DB::table('ads')->where('id', '=', $id)->pluck('adminStatus')->first();
        // Determine the new value based on the current value
        $new_admin_status = $admin_status == 1 ? null : 1;
        // Update the database record with the new adminStatus value
        DB::table('ads')->where('id', '=', $id)->update(['adminStatus' => $new_admin_status]);
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Admin status updated successfully!');
    }
    
       public function status($id){
      $data = DB::table('users')->find($id);
      return $data;
    }

    public function update(Request $request){
    
        try {
            if ($request->user_status) {
                $status = 1;
            } else {
                $status = 0;
            }
    
            $result = DB::table('users')->where('id', $request->id)->update([
                'status' => $status,
            ]);

            // send mail to customer
            if($status == 1){
                $userEmail = DB::table('users')->find($request->id); // Get email

                $body = "Your account is active again in autobox";

                $result = \Mail::send('Admin.activeUser', ['body' => $body], function ($message) use ($request, $userEmail) {
                    $message->from('jayathilaka221b@gmail.com', 'autobox');
                    $message->to($userEmail->email, 'your name')->subject('Autobox');
                });

            }
            else{
                $userEmail = DB::table('users')->find($request->id); // Get email

                $body = "Your account is deactivated from autobox";

                $result = \Mail::send('Admin.activeUser', ['body' => $body], function ($message) use ($request, $userEmail) {
                    $message->from('jayathilaka221b@gmail.com', 'autobox');
                    $message->to($userEmail->email, 'your name')->subject('Autobox');
                });
              
            }
    
            if ($result) {
               
                return response()->json(['code' => 'true', 'msg' => "User status changed"]);
            } else {
                return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 'false', 'msg' => "An error occurred ".$e->getMessage()]);
        }
    }
    
    public function overideAds(Request $req){
    
           try {
               
        DB::table('assign_packages')->where('customer_id', $req->id)->update([
            'available_ad_count' => $req->ad_count,
        ]);
        return redirect()->back();
       
        } catch (QueryException $e) {
            return  $e->getMessage();
        }

    }
    
      public function overideTime(Request $req){
    
           try {
         $result =  DB::table('ads')->where('id', $req->id_edit)->update([
            'ad_expire_date' => $req->date,
        ]);
        
          if ($result) {
               
                return response()->json(['code' => 'true', 'msg' => "Ad expire date extended"]);
            } else {
                return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
            }
       
        } catch (QueryException $e) {
            return  $e->getMessage();
        }

    }
    
           public function overidePackage(Request $req){
    
           try {
               
         $result =  DB::table('assign_packages')->where('customer_id', $req->id)->update([
            'package_expire_date' => $req->expire_date,
        ]);
        
         DB::table('ads')->where('ads_customers_id',$req->id)->update([
             'ad_expire_date' => $req->expire_date,
             ]);
        
          if ($result) {
                return redirect()->back()->with('success', 'Package expire date extended !');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!.');
            }
       
        } catch (QueryException $e) {
            return  $e->getMessage();
        }

    }
}
