<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function provinces(Request $request) // provinsi
    {
        return Province::all();
        
    }
    public function regencies(Request $request, $province_id) // kabupates
    {
        return Regency::where('province_id', $province_id)->get();

    }
}
