<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GlobalDataController extends Controller
{

    public function getBannerAds(Request $request)
    {
        $banners = DB::table('banner')->get();
        if ($banners) {
            return response()->json([
                'stat' => 'ok',
                'banners' => $banners,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }
}
