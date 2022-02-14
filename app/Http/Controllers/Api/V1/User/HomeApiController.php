<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Auth;
use App\SubjectArea;
use App\Parameter;
use App\Option;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    public function form()
    {
        $subject_areas = SubjectArea::with('parameters')->get();
        return response(['subject_areas' => $subject_areas]);
    }
}
