<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Storage;

// use Intervention\Image\ImageManagerStatic as Image;

class AdvertisementController extends Controller
{
    public function getRecentAds()
    {
        $today = now()->toDateString();
        $latest_ads = DB::table('ads')
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->where('ads.status', '1')
            ->where('ad_expire_date', '>', $today)
            ->orderBy('ads.created_at', 'desc')
            ->take(4)
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
            ->get();
        if ($latest_ads) {
            return response()->json([
                'stat' => 'ok',
                'ads' => $latest_ads,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function getFilteredPaginatedAds(Request $request)
    {
        $itemName = $request->input('itemName');
        $vType = $request->input('vType');
        $brandId = $request->input('brandId');
        $modelId = $request->input('modelId');
        $location = $request->input('location');
        $today = now()->toDateString();
        // ['data' => $request->input('condition')." ".$request->input('vType')
        //     ." ".$request->input('brandId')." ".$request->input('modelId')." ".$request->input('low')." "
        //     .$request->input('high')." ".$request->input('location')." ".$request->input('vType')]

        // {"data": "All 4 -1 -1 0 2000000 Location 4"}
        if ($vType != -1) {
            $topAdsData = DB::table('ads')
                ->leftJoin('ads_images', function ($join) {
                    $join->on('ads.id', '=', 'ads_images.ads_id')
                        ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                })
                ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                ->where('ads.vehicle_types_id', $request->input('vType'))
                ->where('ads.status', '1')
                ->where('ads.is_top_id', '1')
                ->where('ad_expire_date', '>', $today)
                ->orderBy('ads.created_at', 'desc')
                ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                ->take(2)->get();
            if ($brandId == '-1' && $location == 'Any Location') {
                $adsData = DB::table('ads')
                        ->leftJoin('ads_images', function ($join) {
                            $join->on('ads.id', '=', 'ads_images.ads_id')
                                ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                        })
                        ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                        ->where('ads.vehicle_types_id', $request->input('vType'))
                        ->where('ads.status', '1')
                        ->where('ad_expire_date', '>', $today)
                        ->where('ad_title', 'like', '%'.$itemName.'%')
                        ->orderBy('ads.created_at', 'desc')
                        ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                        ->paginate(6);
                    if ($adsData) {
                        return response()->json([
                            'stat' => 'ok',
                            'ads' => $adsData,
                            'tad' => $topAdsData,
                            'data_cat' => 'All condition',
                            'filtered' => $request->input('vType') . ' ' . $request->input('condition') . ' ' . $request->input('brandId') . ' ' .
                                $request->input('modelId') . ' ' . $request->input('low') . ' ' . $request->input('high') . ' ' . $request->input('location')
                        ]);
                    } else {
                        return response()->json(['stat' => 'error']);
                    }
            } else if ($brandId != '-1' && $location == 'Any Location') {
                $topAdsData = DB::table('ads')
                    ->leftJoin('ads_images', function ($join) {
                        $join->on('ads.id', '=', 'ads_images.ads_id')
                            ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                    })
                    ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                    ->where('ads.vehicle_types_id', $request->input('vType'))
                    ->where('ads.status', '1')
                    ->where('ads.is_top_id', '1')
                    ->where('ad_expire_date', '>', $today)
                    ->where('ads.brands_id', $request->input('brandId'))
                    ->orderBy('ads.created_at', 'desc')
                    ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                    ->take(2)->get();

                    $adsData = DB::table('ads')
                    ->leftJoin('ads_images', function ($join) {
                        $join->on('ads.id', '=', 'ads_images.ads_id')
                            ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                    })
                    ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                    ->where('ads.vehicle_types_id', $request->input('vType'))
                    ->where('ads.status', '1')
                    ->where('ads.brands_id', $request->input('brandId'))
                    ->where('ads.models_id', $request->input('modelId'))
                    ->where('ad_title', 'like', '%'.$itemName.'%')
                    ->where('ad_expire_date', '>', $today)
                    ->orderBy('ads.created_at', 'desc')
                    ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                    ->paginate(6);
                if ($adsData) {
                    return response()->json([
                        'stat' => 'ok',
                        'ads' => $adsData,
                        'tad' => $topAdsData,
                        'data_cat' => 'All condition',
                        'filtered-type-brand-model-cALL' => $request->input('vType') . ' ' . $request->input('condition') .
                            ' ' . $request->input('brandId') . ' ' .
                            $request->input('modelId') . ' ' . $request->input('low') . ' ' .
                            $request->input('high') . ' ' . $request->input('location')
                    ]);
                } else {
                    return response()->json(['stat' => 'error']);
                }
            } else if ($brandId == '-1' && $location != 'Any Location') {
                    $adsData = DB::table('ads')
                        ->leftJoin('ads_images', function ($join) {
                            $join->on('ads.id', '=', 'ads_images.ads_id')
                                ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                        })
                        ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                        ->where('ads.vehicle_types_id', $request->input('vType'))
                        ->where('ads.status', '1')
                        ->where('ads.ad_district', $request->input('location'))
                        ->where('ad_title', 'like', '%'.$itemName.'%')
                        ->where('ad_expire_date', '>', $today)
                        ->orderBy('ads.created_at', 'desc')
                        ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                        ->paginate(6);
                    if ($adsData) {
                        return response()->json([
                            'stat' => 'ok',
                            'ads' => $adsData,
                            'tad' => $topAdsData,
                            'data_cat' => 'All condition',
                            'filtered' => $request->input('vType') . ' ' . $request->input('condition') . ' ' . $request->input('brandId') . ' ' .
                                $request->input('modelId') . ' ' . $request->input('low') . ' ' . $request->input('high') . ' ' . $request->input('location')
                        ]);
                    } else {
                        return response()->json(['stat' => 'error']);
                    }
            } else {
                $topAdsData = DB::table('ads')
                    ->leftJoin('ads_images', function ($join) {
                        $join->on('ads.id', '=', 'ads_images.ads_id')
                            ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                    })
                    ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                    ->where('ads.vehicle_types_id', $request->input('vType'))
                    ->where('ads.status', '1')
                    ->where('ads.is_top_id', '1')
                    ->where('ads.brands_id', $request->input('brandId'))
                    ->where('ad_expire_date', '>', $today)
                    ->orderBy('ads.created_at', 'desc')
                    ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                    ->take(2)->get();
                    $adsData = DB::table('ads')
                        ->leftJoin('ads_images', function ($join) {
                            $join->on('ads.id', '=', 'ads_images.ads_id')
                                ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                        })
                        ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                        ->where('ads.vehicle_types_id', $request->input('vType'))
                        ->where('ads.status', '1')
                        ->where('ads.ad_district', $request->input('location'))
                        ->where('ads.brands_id', $request->input('brandId'))
                        ->where('ads.models_id', $request->input('modelId'))
                        ->where('ad_title', 'like', '%'.$itemName.'%')
                        ->where('ad_expire_date', '>', $today)
                        ->orderBy('ads.created_at', 'desc')
                        ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                        ->paginate(6);
                    if ($adsData) {
                        return response()->json([
                            'stat' => 'ok',
                            'ads' => $adsData,
                            'tad' => $topAdsData,
                            'data_cat' => 'All condition',
                            'filtered' => $request->input('vType') . ' ' . $request->input('condition') . ' ' . $request->input('brandId') . ' ' .
                                $request->input('modelId') . ' ' . $request->input('low') . ' ' . $request->input('high') . ' ' . $request->input('location')
                        ]);
                    } else {
                        return response()->json(['stat' => 'error']);
                    }
            }
        } else {
            $topAdsData = DB::table('ads')
                ->leftJoin('ads_images', function ($join) {
                    $join->on('ads.id', '=', 'ads_images.ads_id')
                        ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                })
                ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                ->where('ads.status', '1')
                ->where('ads.is_top_id', '1')
                ->where('ad_expire_date', '>', $today)
                ->orderBy('ads.created_at', 'desc')
                ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                ->take(2)->get();
            if ($location == 'Any Location') {
                    $adsData = DB::table('ads')
                        ->leftJoin('ads_images', function ($join) {
                            $join->on('ads.id', '=', 'ads_images.ads_id')
                                ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                        })
                        ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                        ->where('ads.status', '1')
                        ->where('ad_title', 'like', '%'.$itemName.'%')
                        ->where('ad_expire_date', '>', $today)
                        ->orderBy('ads.created_at', 'desc')
                        ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                        ->paginate(6);
                    if ($adsData) {
                        return response()->json([
                            'stat' => 'ok',
                            'ads' => $adsData,
                            'tad' => $topAdsData,
                            'data_cat' => 'All condition',
                            'test_type'=>'tttttttttttttttttttttttttt',
                            'filtered' => $request->input('vType') . ' ' . $request->input('condition') . ' ' . $request->input('brandId') . ' ' .
                                $request->input('modelId') . ' ' . $request->input('low') . ' ' . $request->input('high') . ' ' . $request->input('location')
                        ]);
                    } else {
                        return response()->json(['stat' => 'error']);
                    }
            }  else if ($location != 'Any Location') {
                    $adsData = DB::table('ads')
                        ->leftJoin('ads_images', function ($join) {
                            $join->on('ads.id', '=', 'ads_images.ads_id')
                                ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
                        })
                        ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
                        ->where('ads.ad_district', $request->input('location'))
                        ->where('ads.status', '1')
                        ->where('ad_title', 'like', '%'.$itemName.'%')
                        ->where('ad_expire_date', '>', $today)
                        ->orderBy('ads.created_at', 'desc')
                        ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
                        ->paginate(6);
                    if ($adsData) {
                        return response()->json([
                            'stat' => 'ok',
                            'ads' => $adsData,
                            'tad' => $topAdsData,
                            'data_cat' => 'All condition',
                            'filtered' => $request->input('vType') . ' ' . $request->input('condition') . ' ' . $request->input('brandId') . ' ' .
                                $request->input('modelId') . ' ' . $request->input('low') . ' ' . $request->input('high') . ' ' . $request->input('location')
                        ]);
                    } else {
                        return response()->json(['stat' => 'error']);
                    }
            } 
        }
    }

    public function searchAdsThroughText(Request $request)
    {
        $today = now()->toDateString();
        if ($request->st != '') {
            $s_results = DB::table('ads')
                ->where('ad_title', 'like', $request->st . '%')->where('ads.status', '1')
                ->where('ad_expire_date', '>', $today)
                ->take(10)
                ->select('ad_title', 'id')
                ->get();
            if ($s_results) {
                return response()->json([
                    'stat' => 'ok',
                    'results' => $s_results,
                ]);
            } else {
                return response()->json(['stat' => 'error']);
            }
        } else {
            return response()->json([
                'stat' => 'ok',
            ]);
        }
    }

    public function PlaceAnInquiry(Request $request)
    {
        $image_1 = time() . rand(1, 1000) . '.' . $request->image->extension();
        $image = Image::make($request->file('image'))->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        }); // Create an instance of the image

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
        $id = DB::table('ads_inquery')->insertGetId(
            [
                'image' => $image_1,
                'title' => $request->input('title'),
                'phone' => $request->input('phone'),
                'userID' => $request->input('userID'),
                'additional_information' => $request->input('additional_information'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        if ($id) {
            return response()->json(['stat' => 'ok', 'data' => $id]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function createAd(Request $request)
    {
        try {
            $now = new DateTime();
            $ad = DB::table('ads')->insertGetId(
                [
                    'ad_number' => str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT),
                    'ad_title' => $request->input('ad_title'),
                    'ad_district' => $request->input('ad_district'),
                    'ad_city' => $request->input('ad_city'),
                    'ad_description' => $request->input('ad_description'),
                    'ad_price' => $request->input('ad_price'),
                    'ad_view_count' => 0,
                    'ad_expire_date' => Carbon::now()->addDays(30),
                    'status' => 1,
                    'adminStatus' => 1,
                    'vehicle_types_id' => $request->input('vehicle_types_id'),
                    'brands_id' => $request->input('brands_id'),
                    'models_id' => $request->input('models_id'),
                    'ads_condition' => $request->input('ads_condition'),
                    'ads_parts_accessory_type' => null,
                    'ads_customers_id' => $request->input('ads_customers_id'),
                    'is_top_id' => $request->input('is_top_id'),
                    'top_ad_expire_date' => $top_ad_expire_date = isset($check_top_ad_count)  ? Carbon::now()->addDays(1) : null, // check top ad or not
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'negotiable' => $request->input('negotiable'),
                ]
            );

            for ($i = 0; $i < 10; $i++) {
                if ($request->has('img' . $i)) {
                    //echo ('img' . $i . ' is available');
                    $file = $request->file('img' . $i);
                    $image_1 = time() . rand(1, 1000) . '.' . $file->extension();
                    $image = Image::make($file)->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    }); // Create an instance of the image

                    $watermarkText = "AUTOBOX";

                    $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                        $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                        $font->size(20); // Set the font size
                        $font->color(['255', '255', '255']); // Set the font color
                        $font->align('center'); // Set the text alignment
                        $font->valign('middle'); // Set the text vertical alignment
                        $font->angle(0); // Set the text rotation angle

                    });

                    $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_1}"));
                    //echo ('img' . $i . ' saved ' . $image_1);
                    DB::table('ads_images')->insertGetId(
                        [
                            'name' => $image_1,
                            'ads_id' => $ad,
                        ]
                    );
                }
            }
            if ($ad) {
                $tad = $request->input('is_top_id');
                DB::table('assign_packages')
                    ->where('customer_id', $request->input('ads_customers_id'))
                    ->decrement('available_ad_count', 1);
                if ($tad == 1) {
                    DB::table('assign_packages')
                        ->where('customer_id', $request->input('ads_customers_id'))
                        ->decrement('available_top_count', 1);
                }
                return response()->json([
                    'stat' => 'ok',
                    'ad_id' => $ad,
                    'tad' => ($tad),
                    'tad_' => ($tad == 1),
                ]);
            } else {
                return response()->json(['stat' => 'error', 'msg' => 'db error']);
            }
        } catch (\Exception $e) {
            return response()->json(['stat' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function updateAd(Request $request)
    {
        try {
            $now = new DateTime();
            $ad = DB::table('ads')
                ->where('id', $request->ad_id)
                ->update(
                    [
                        'ad_title' => $request->input('ad_title'),
                        'ad_description' => $request->input('ad_description'),
                        'updated_at' => Carbon::now(),
                        'ad_price' => $request->input('ad_price'),
                        'ads_condition' => $request->input('ads_condition'),
                        'negotiable' => $request->input('negotiable'),
                    ]
                );
            if ($ad) {
                return response()->json([
                    'stat' => 'ok',
                    'ad_id' => $ad,
                ]);
            } else {
                return response()->json(['stat' => 'error', 'msg' => 'DB error']);
            }
        } catch (\Exception $e) {
            return response()->json(['stat' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function disableAd(Request $request)
    {
        try {
            $now = new DateTime();
            $ad = DB::table('ads')
                ->where('id', $request->ad_id)
                ->update(
                    [
                        //$request->input('ad_number')
                        'updated_at' => Carbon::now(),
                        'status' => '0',
                    ]
                );
            if ($ad) {
                return response()->json([
                    'stat' => 'ok',
                    'ad_id' => $ad,
                ]);
            } else {
                return response()->json(['stat' => 'error', 'msg' => 'DB error']);
            }
        } catch (\Exception $e) {
            return response()->json(['stat' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function getAdData(Request $request)
    {
        $current_ad = DB::table('ads')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->join('ads_images', 'ads.id', '=', 'ads_images.ads_id')
            ->where('ads.id', $request->input('adId'))
            ->select(
                'ads_images.name',
                'ads.ad_title',
                'ads.ad_price',
                'ads.ad_title',
                'ads.id',
                'vehicle_types.vt_name',
                'ads.ad_district',
                'ads.ad_description',
                'ads.ad_city',
                'ads.created_at',
                'ads.ad_number',
                'ads.is_top_id',
                'ads.brands_id',
                'ads.models_id',
                'ads.ads_condition',
                'ads.ads_customers_id',
                'ads.ad_view_count',
                'ads.negotiable',
                'ads.status'
            )
            ->get();
        if ($current_ad) {
            return response()->json([
                'stat' => 'ok',
                'ad' => $current_ad,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function updateAdViewCountByOne(Request $request)
    {
        DB::table('ads')
            ->where('id', $request->input('adId'))
            ->increment('ad_view_count');
    }

    public function getAllInquiry(Request $request)
    {
        $uid = $request->uid;
        $inq = DB::table('ads_inquery')
                ->where('userID',"!=", $uid)
                ->orderBy('created_at', 'desc')
                ->select('title', 'phone', 'additional_information', 'userID', 'created_at', 'id','image')
                ->paginate(20);
            if ($inq) {
                return response()->json([
                    'stat' => 'ok',
                    'inq' => $inq,
                    'check' => 'all'
                ]);
            } else {
                return response()->json(['stat' => 'error']);
            }
    }

    public function getMyInquiry(Request $request)
    {
        $uid = $request->uid;
        $inq = DB::table('ads_inquery')
                ->where('userID', $uid)
                ->orderBy('created_at', 'desc')
                ->select('title', 'phone', 'additional_information', 'userID', 'created_at', 'id','image')
                ->paginate(20);
            if ($inq) {
                return response()->json([
                    'stat' => 'ok',
                    'inq' => $inq,
                    'check' => 'all'
                ]);
            } else {
                return response()->json(['stat' => 'error']);
            }
    }

    public function deleteInq(Request $request)
    {
        $id = $request->id;
        $inq = DB::table('ads_inquery')
                ->where('id', $id)
                ->delete();
            if ($inq) {
                return response()->json([
                    'stat' => 'ok',
                ]);
            } else {
                return response()->json(['stat' => 'error']);
            }
    }

}
