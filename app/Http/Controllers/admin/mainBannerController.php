<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;

class mainBannerController extends Controller
{
     public function index(){
        return view('Admin.mainBanner');
    }

    public function create(Request $request)
    {
        $request->validate([
            'slider' => 'required',
        ], [
            'slider.required' => 'The main banner field is required.',
        ]);
        
        try { // this is rest of the things

            $slider_image = time() . rand(1, 100) . '.' . $request->slider->extension();
            $request->slider->move(public_path("assets/myCustomThings/mainBanner"), $slider_image); //rename image and upload

            $result = DB::table('banner')->insert([
                'image' => $slider_image,
            ]);

            if ($result) {
                return response()->json(['code' => 'success', 'msg' => 'banner added']);
            } else {
                return response()->json(['code' => 'error', 'msg' => 'something went wrong']);
            }
        } catch (Exception $e) {
            // Exception occurred, handle it here
            return response()->json(['code' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function recieveData(){
        $data =  DB::table('banner')->orderBy('id', 'asc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="delete btn btn-danger btn-sm m-1"><i class="bi bi-x-lg"></i>Delete</a>';
                return $btn;
            })
            ->addColumn('image', function ($data) {
                $url = asset("assets/myCustomThings/mainBanner/$data->image");
                return '<img style="  width:155px !important; height:155px !important; object-fit:contain !important;" src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
            })

            ->rawColumns(['action', 'image'])
            ->make(true);
    }
    public function delete($id)
    {
           // Get the image file name from the database
    $banner = DB::table('banner')->where('id', $id)->first();
    
    if (!$banner) {
        return response()->json(['code' => 'error', 'msg' => 'Banner not found']);
    }

    $imageName = $banner->image;

    // Delete the record from the database
    $result = DB::table('banner')->where('id', $id)->delete();

    if ($result) {
        // Delete the associated image from local storage
        if (Storage::disk('public')->exists('assets/myCustomThings/mainBanner/' . $imageName)) {
            Storage::disk('public')->delete('assets/myCustomThings/mainBanner/' . $imageName);
        }

        return response()->json(['code' => 'success', 'msg' => 'Banner deleted']);
    } else {
        return response()->json(['code' => 'error', 'msg' => 'Something went wrong']);
    }
    }
}
