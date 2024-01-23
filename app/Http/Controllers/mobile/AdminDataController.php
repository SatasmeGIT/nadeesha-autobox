<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminDataController extends Controller
{
    public function getBrandModel(Request $request){
        $brm = DB::table('brand')
            ->join('model', 'brand.id', '=', 'model.brand_id')
            ->where('model.status', '1')
            ->get(['model.id','model.model_name','model.brand_id']);

            $brands = DB::table('brand')
            ->where('status','1')
            ->get(['id','brand_name','vt_id']);

            if ($brm &&  $brands) {
                return response()->json([
                    'stat' => 'ok',
                    'brm' => $brm,
                    'brands' => $brands,
                ]);
            } else {
                return response()->json(['stat' => 'error']);
            }
    }

    public function getDistricts(Request $request){
        $districts = DB::table('districts')
        ->get(['id','name_en']);
        if ($districts) {
            return response()->json([
                'stat' => 'ok',
                'data' => $districts,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function getVehicleTypes(Request $request){
        $vtype = DB::table('vehicle_types')
        ->get(['id','vt_name']);
        if ($vtype) {
            return response()->json([
                'stat' => 'ok',
                'data' => $vtype,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function getCities(Request $request){
        $cities = DB::table('cities')
        ->where('district_id',$request->input('district_id'))
        ->get(['id','name_en']);
        if ($cities) {
            return response()->json([
                'stat' => 'ok',
                'data' => $cities,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

}
