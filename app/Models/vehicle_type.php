<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class vehicle_type extends Model
{
    use HasFactory;
    public function getBrands()
    {
        return $this->hasMany(brand::class, 'vt_id')->where('status', 1);
    }
    
     public function adsCount()
    {
       return DB::table('ads')
        ->where('vehicle_types_id', $this->id)
        ->whereDate('ad_expire_date', '>', Carbon::now())
        ->count();
    }
}
