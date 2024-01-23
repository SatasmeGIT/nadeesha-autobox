<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class adsManagementAdminController extends Controller
{
    public function index(){
        
        return view("Admin.adsManagement"); // display view
   
    }
    
    public function recieveData(){
        
    $data =  DB::table('ads')->get();
    return datatables()->of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($data) {
        $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="more btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>more</a>';
        $btn = $btn . '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="status btn btn-warning btn-sm m-1"><i class="bi bi-x-lg"></i> Status</a>';
        $btn = $btn . '<a style="color:blue !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="url btn btn-link btn-sm m-1"><i class="bi bi-x-lg"></i> Visit Ad</a>';
        return $btn;
      })
      ->addColumn('status_admin', function ($data) {
        if ($data->adminStatus == 1) {
          $status_admin = '<span class="badge badge-pill badge-soft-success">Active</span>';
        } else {
          $status_admin = ' <span class="badge badge-pill badge-soft-danger">Deactive</span>';
        }
        return $status_admin;
      })
      ->addColumn('status', function ($data) {
        if ($data->status == 1) {
          $status = '<span class="badge badge-pill badge-soft-success">Active</span>';
        } else {
          $status = ' <span class="badge badge-pill badge-soft-danger">Deactive</span>';
        }
        return $status;
      })
        ->addColumn('is_top_id', function ($data) {
        if ($data->is_top_id == 1) {
          $is_top_id = '<span class="badge badge-pill badge-soft-success">Yes</span>';
        } else {
          $is_top_id = ' <span class="badge badge-pill badge-soft-danger">No</span>';
        }
        return $is_top_id;
      })
       ->addColumn('extends', function ($data) {
        $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="extends btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>extends</a>';
        return $btn;
      })
      ->rawColumns(['action', 'status','status_admin','is_top_id','extends'])
      ->make(true);
   
    }
    
    public function more($id){
      
      return DB::table('ads')->find($id);  
        
    }
    
    public function status($id){
        
       return DB::table('ads')->find($id);    
    }
    
     public function updateStatus(Request $request){
        if (isset($request->ad_edit_status)) {
          $status = 1;
        } else {
          $status = 0;
        }
        
        // update data 
        $result = DB::table('ads')->where('id', $request->id_edit)->update([
          'adminStatus' => $status,
        ]);
    
        if ($result) {
          return response()->json(['code' => 'true', 'msg' => "Status changed"]);
        } else {
          return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
         
    }
    
}
