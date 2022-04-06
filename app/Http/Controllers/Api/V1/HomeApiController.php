<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use App\Province;
use App\District;
use App\Form;

class HomeApiController extends Controller
{
    public function index(){
        $organizations = Organization::with('province','district')->get();
        $total_orgs = $organizations->count();

        $provinces = Province::with('districts')->get();

        
        $published_forms = Form::where('final_verified',1)->count();

        $highest_score = Form::where('final_verified',1)->max('total_marks_finalVerifier');
        $lowest_score = Form::where('final_verified',1)->min('total_marks_finalVerifier');
        $average_score = Form::where('final_verified',1)->avg('total_marks_finalVerifier');

        $highestScoreOrgs = Organization::whereHas('forms',function($query) use($highest_score){
            $query->where('final_verified',1)
            ->where('total_marks_finalVerifier',$highest_score);
        })->get();

        $lowestScoreOrgs = Organization::whereHas('forms',function($query) use($lowest_score){
            $query->where('final_verified',1)
            ->where('total_marks_finalVerifier',$lowest_score);
        })->get();

        $topOrgs = Form::where('final_verified',1)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

        $lowOrgs = Form::where('final_verified',1)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

        

        return response([
            'organizations'=> $organizations,
            'provinces' => $provinces,
            'total_orgs' => $total_orgs,
            'published_forms' => $published_forms,
            'highest_score' => $highest_score,
            'lowest_score' => $lowest_score,
            'average_score' => $average_score,
            'highestScoreOrgs' => $highestScoreOrgs,
            'lowestScoreOrgs' => $lowestScoreOrgs,
            'topOrgs' => $topOrgs,
            'lowOrgs' => $lowOrgs,
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

    public function organizationDetail(Request $request, Organization $organization)
    {
        $forms = $organization->forms()->where('final_verified',1)->with('subjectAreas')->get();
        return response([
            'forms' => $forms
        ]);
    }
}
