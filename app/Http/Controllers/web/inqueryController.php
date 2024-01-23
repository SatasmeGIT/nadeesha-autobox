<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class inqueryController extends Controller
{
    public function index()
    {
    
        $vendorDetails = session('vendor_data');
        
          $userId = DB::table('users')
        ->where('name', $vendorDetails->name) // Access 'name' property using -> notation
        ->pluck('id')
        ->first();
        
          $vendor_has_premium = DB::table('assign_packages') //check vendor has primium packages or not 
               ->where('customer_id', $vendorDetails->id)
               ->where('package_id', '!=', 5) // Exclude rows with package_id equal to 5
               ->exists();
               
        

        return view('Web.ads_inquery',compact('userId','vendor_has_premium'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
            'title' => 'required|max:200',
            'phone' => 'required|digits:9',
            'additional_information' => 'required|max:3000',
        ]);

        try {
            $image_1 = '';
            if ($request->image) {

                $image_1 = time() . rand(1, 1000) . '.' . $request->image->extension();
                $image = Image::make($request->file('image'))->resize(460, 400); // Create an instance of the image

                $watermarkText = "AUTOBOX";
                $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(40); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(45); // Set the text rotation angle

                });
                $image->save(public_path("assets/myCustomThings/Inquery/{$image_1}"));
            }

            $result = DB::table('ads_inquery')->insert([
                'image' => $image_1,
                'title' => $request->title,
                'phone' =>  $request->phone,
                'userID' =>  $request->userId,
                'additional_information' => $request->additional_information,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

            if ($result) {
                return response()->json(['code' => 200, 'msg' => 'ad inquery added succesfully']);
            } else {
                return response()->json(['code' => 400, 'msg' => 'something went wrong']);
            }
        } catch (Exception $e) {
            // Exception occurred, handle it here
            return response()->json(['code' => 500, 'msg' => $e->getMessage()]);
        }
    }

    public function display()
    { 
         $vendorDetails = session('vendor_data');
         
         $vendor_has_premium = DB::table('assign_packages') //check vendor has primium packages or not 
               ->where('customer_id', $vendorDetails->id)
               ->where('package_id', '!=', 5) // Exclude rows with package_id equal to 5
               ->exists();
               
         $userId = DB::table('users')
        ->where('name', $vendorDetails->name) // Access 'name' property using -> notation
        ->pluck('id')
        ->first();
        
        // function to display inquery ads on the blade
        $inquery_ads = DB::table('ads_inquery')
        ->whereNotIn('userID', [$userId]) // Pass the user ID in an array
        ->paginate(12);

        $inquery_ads_count =  DB::table('ads_inquery')
        ->whereNotIn('userID', [$userId])->count();
        
          // client has primium package redirect Web.inqueryAds  or visitor page 
          if($vendor_has_premium){
           return view('Web.inqueryAds', compact('inquery_ads', 'inquery_ads_count','vendor_has_premium'));return view('Web.inqueryAds', compact('inquery_ads', 'inquery_ads_count','vendor_has_premium'));   
          }
          else{
           return redirect()->route('web.inquery_for_visitors');  
          }

        
    }
    
    public function inquery_for_visitors(){
        
        return view('Web.inquery_visitors');
    }
    
    public function recieveData(){
         $vendorDetails = session('vendor_data');
        
         $userId = DB::table('users')
        ->where('name', $vendorDetails->name) // Access 'name' property using -> notation
        ->pluck('id')
        ->first();
        
          $data =  DB::table('ads_inquery')->where('userID',$userId)->orderBy('id', 'asc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important; background-color: red !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="delete btn btn-sm m-1"><i class="bi bi-x-lg"></i>Delete</a>';
                return $btn;
            })
             ->addColumn('more', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="more btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>More</a>';
                return $btn;
            })
            ->addColumn('image', function ($data) {
                $url = asset("assets/myCustomThings/Inquery/$data->image");
                return '<img style="  width:155px !important; height:155px !important; object-fit:contain !important;" src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
            })

            ->rawColumns(['action', 'image','more'])
            ->make(true);
    }
    
      public function delete($id)
    {
           // Get the image file name from the database
    $inquery = DB::table('ads_inquery')->where('id', $id)->first();
    
    if (!$inquery) {
        return response()->json(['code' => 'error', 'msg' => 'Inquery not found']);
    }

    $imageName = $inquery->image;

    // Delete the record from the database
    $result = DB::table('ads_inquery')->where('id', $id)->delete();

    if ($result) {
        // Delete the associated image from local storage
        if (Storage::disk('public')->exists('assets/myCustomThings/Inquery/' . $imageName)) {
            Storage::disk('public')->delete('assets/myCustomThings/Inquery/' . $imageName);
        }

        return response()->json(['code' => 'success', 'msg' => 'Inquery deleted']);
    } else {
        return response()->json(['code' => 'error', 'msg' => 'Something went wrong']);
    }
    }
    
    public function info($id){
        $data = DB::table('ads_inquery')->find($id);
        return $data;
    }
}
