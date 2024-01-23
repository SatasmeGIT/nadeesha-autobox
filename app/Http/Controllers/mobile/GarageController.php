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

class GarageController extends Controller
{
    public function getFilteredPaginatedGarages(Request $request)
    {
        if ($request->location != 'Location') {
            $garages = DB::table('garage')
                ->where('status', 1)
                ->where('city', $request->location)
                ->orderBy('name', 'asc')
                ->select('name', 'address', 'city', 'image', 'number', 'id')
                ->paginate(6);

            if ($garages) {
                return response()->json([
                    'stat' => 'ok',
                    'garages' => $garages,
                    'check' => 'all'
                ]);
            } else {
                return response()->json(['stat' => 'error']);
            }
        } else {
            $garages = DB::table('garage')
                ->where('status', 1)
                ->orderBy('name', 'asc')
                ->select('name', 'address', 'city', 'image', 'number', 'id')
                ->paginate(6);

            if ($garages) {
                return response()->json([
                    'stat' => 'ok',
                    'garages' => $garages,
                    'check' => 'all'
                ]);
            } else {
                return response()->json(['stat' => 'error']);
            }
        }
    }

    public function getGarageData(Request $request)
    {
        $garage = DB::table('garage')
            ->where('id', $request->gid)
            ->select('name', 'address', 'city', 'image', 'number', 'desc', 'url', 'created_at')
            ->first();
        if ($garage) {
            return response()->json([
                'stat' => 'ok',
                'garage' => $garage,
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function getUserGarages(Request $request)
    {
        $garages = DB::table('garage')
            ->where('user_id', $request->user_id)
            ->orderBy('name', 'asc')
            ->select('name', 'address', 'city', 'image', 'number', 'id')
            ->paginate(6);

        if ($garages) {
            return response()->json([
                'stat' => 'ok',
                'garages' => $garages,
                'check' => 'all'
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }

    public function createGarage(Request $request)
    {

        $image_1 = time() . rand(1, 1000) . '.' . $request->garage_logo->extension();
        $image = Image::make($request->file('garage_logo'))->resize(200, 200, function ($constraint) {
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

        $image->save(public_path("assets/myCustomThings/Garage/{$image_1}"));

        $garages = DB::table('garage')->insertGetId(
            [
                'user_id' => $request->input('user_id'),
                'name' => $request->input('garage_name'),
                'city' => $request->input('city'),
                'number' => $request->input('tele'),
                'url' => $request->input('google_location'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'desc' => $request->input('desc'),
                'address' => $request->input('address'),
                'image' => $image_1,
                'status' => 0,
            ]
        );

        if ($garages) {
            return response()->json([
                'stat' => 'ok',
            ]);
        } else {
            return response()->json(['stat' => 'error']);
        }
    }
}
