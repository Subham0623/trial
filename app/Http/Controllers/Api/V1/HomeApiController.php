<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use App\Province;
use App\District;

class HomeApiController extends Controller
{
    public function index(){
        $organizations = Organization::with('province','district')->get();
        $provinces = Province::with('districts')->get();
        return response([
            'organizations'=> $organizations,
            'provinces' => $provinces
    ]);
    }

    public function province(Request $request)
    {
        // dd($request->all());
        $organizations = Province::findOrFail($request->province_id)->organizations()->get();
        return response([
            'organizations' => $organizations,
        ]);
    }
}
