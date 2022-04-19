<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use App\Province;
use App\District;
use App\Form;
use Carbon\Carbon;
use App\FormDetail;
use App\FormSubjectArea;
use App\SubjectArea;
use App\Parameter;

class HomeApiController extends Controller
{
    public function index(){
        $organizations = Organization::with('province','district')->get();
        $total_orgs = $organizations->count();

        $districts = District::all();

        $years = Form::finalVerified()->distinct()->pluck('year');

        $fiscal_year = Form::finalVerified()->latest()->pluck('year')->first();

        $provinces = Province::with('districts')->get();

        
        $published_forms = Form::finalVerified()->where('year',$fiscal_year)->get();
        $forms = $published_forms->pluck('id');
        $published_forms = $published_forms->count();

        $highest_score = Form::finalVerified()->where('year',$fiscal_year)->max('total_marks_finalVerifier');
        // dd($highest_score->max('total_marks_finalVerifier'));
        $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->min('total_marks_finalVerifier');
        $average_score = Form::finalVerified()->where('year',$fiscal_year)->avg('total_marks_finalVerifier');

        $highestScoreOrgs = Organization::whereHas('forms',function($query) use($highest_score, $fiscal_year){
            $query->finalVerified()
            ->where('year',$fiscal_year)
            ->where('total_marks_finalVerifier',$highest_score);
        })->get();

        $lowestScoreOrgs = Organization::whereHas('forms',function($query) use($lowest_score, $fiscal_year){
            $query->finalVerified()
            ->where('year',$fiscal_year)
            ->where('total_marks_finalVerifier',$lowest_score);
        })->get();

        $topOrgs = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();
       
        $lowOrgs = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

        $orgs = Organization::whereHas('forms',function($query) use ($fiscal_year){
            $query->where('year',$fiscal_year)
            ->where('status',1);
        })->get();

        $submittedFormOrgs = $orgs->count();

        $subjectAreas = SubjectArea::all();

        $total_marks = $this->totalMarks($subjectAreas,$forms,$published_forms);

        return response([
            'organizations'=> $organizations,
            'provinces' => $provinces,
            'districts' => $districts,
            'total_orgs' => $total_orgs,
            'published_forms' => $published_forms,
            'highest_score' => $highest_score,
            'lowest_score' => $lowest_score,
            'average_score' => $average_score,
            'topOrgs' => $topOrgs,
            'lowOrgs' => $lowOrgs,
            'years' => $years,
            'submittedFormOrgs' => $submittedFormOrgs,
            'total_marks' => $total_marks,
            
            ]);
    }

    public function filter(Request $request)
    {
        $fiscal_year = $request->fiscal_year;
        $province = $request->province;
        $district = $request->district;

        $provinces = Province::all();
        $districts = District::all();


        $years = Form::finalVerified()->distinct()->pluck('year');

        if((isset($fiscal_year)) && ($province == null) && ($district == null))
        {
            $organizations = Organization::with('province','district')->get();

            $published_forms = Form::finalVerified()->where('year',$fiscal_year)->get();
            $forms = $published_forms->pluck('id');
            $published_forms = $published_forms->count();
    
            $highest_score = Form::finalVerified()->where('year',$fiscal_year)->max('total_marks_finalVerifier');
            $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->min('total_marks_finalVerifier');
            $average_score = Form::finalVerified()->where('year',$fiscal_year)->avg('total_marks_finalVerifier');
    
            $highestScoreOrgs = Organization::whereHas('forms',function($query) use($highest_score, $fiscal_year){
                $query->finalVerified()
                ->where('year',$fiscal_year)
                ->where('total_marks_finalVerifier',$highest_score);
            })->get();
    
            $lowestScoreOrgs = Organization::whereHas('forms',function($query) use($lowest_score, $fiscal_year){
                $query->finalVerified()
                ->where('year',$fiscal_year)
                ->where('total_marks_finalVerifier',$lowest_score);
            })->get();
    
            $topOrgs = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();
    
            $lowOrgs = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();
            
            $orgs = Organization::whereHas('forms',function($query) use ($fiscal_year){
                $query->where('year',$fiscal_year)
                ->where('status',1);
            })->get();
    
            $submittedFormOrgs = $orgs->count();
        
            $subjectAreas = SubjectArea::all();

            $total_marks = $this->totalMarks($subjectAreas,$forms,$published_forms);
        }
        
        if(isset($province))
        {
            $districts = Province::where('id',$province)->with('districts')->get();
            if(isset($district))
            {

                $organizations = Organization::where('province_id', $province)->where('district_id', $district)->get();

                $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province, $district){
                    $query->where('province_id',$province)
                    ->where('district_id',$district);
                })->get();

                $forms = $published_forms->pluck('id');
                $published_forms = $published_forms->count();
    
                $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province, $district){
                    $query->where('province_id',$province)
                    ->where('district_id',$district);
                })->max('total_marks_finalVerifier');
                
    
                $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province, $district){
                    $query->where('province_id',$province)
                    ->where('district_id',$district);
                })->min('total_marks_finalVerifier');
    
                $average_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province, $district){
                    $query->where('province_id',$province)
                    ->where('district_id',$district);
                })->avg('total_marks_finalVerifier');
    
                $highestScoreOrgs = Organization::where('province_id',$province)->where('district_id',$district)->whereHas('forms',function($query) use($highest_score, $fiscal_year){
                    $query->finalVerified()
                    ->where('year',$fiscal_year)
                    ->where('total_marks_finalVerifier',$highest_score);
                })->get(); 
                
                $lowestScoreOrgs = Organization::where('province_id',$province)->where('district_id',$district)->whereHas('forms',function($query) use($lowest_score, $fiscal_year){
                    $query->finalVerified()
                    ->where('year',$fiscal_year)
                    ->where('total_marks_finalVerifier',$lowest_score);
                })->get();
        
                $topOrgs = Organization::where('province_id',$province)->where('district_id',$district)->whereHas('forms',function($q) use ($fiscal_year){
                    $q->where('year',$fiscal_year)
                    ->orderBy('total_marks_finalVerifier','DESC')
                    ->with('organization','subjectAreas')
                    ->take(10);
                })->get();
        
                $lowOrgs = Organization::where('province_id',$province)->where('district_id',$district)->whereHas('forms',function($q) use ($fiscal_year){
                    $q->where('year',$fiscal_year)
                    ->orderBy('total_marks_finalVerifier','ASC')
                    ->with('organization','subjectAreas')
                    ->take(10);
                })->get();

                $orgs = Organization::where('province_id',$province)->where('district_id',$district)->whereHas('forms',function($query) use ($fiscal_year){
                    $query->where('year',$fiscal_year)
                    ->where('status',1);
                })->get();
        
                $submittedFormOrgs = $orgs->count();
            
                $subjectAreas = SubjectArea::all();

                $total_marks = $this->totalMarks($subjectAreas,$forms,$published_forms);
            }
            else
            {
                $organizations = Organization::where('province_id', $province)->get();

                $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province){
                    $query->where('province_id',$province);
                })->get();
                $forms = $published_forms->pluck('id');
                $published_forms = $published_forms->count();
    
                $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province){
                    $query->where('province_id',$province);
                })->max('total_marks_finalVerifier');
                
    
                $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province){
                    $query->where('province_id',$province);
                })->min('total_marks_finalVerifier');
    
                $average_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province){
                    $query->where('province_id',$province);
                })->avg('total_marks_finalVerifier');
    
                $highestScoreOrgs = Organization::where('province_id',$province)->whereHas('forms',function($query) use($highest_score, $fiscal_year){
                    $query->finalVerified()
                    ->where('year',$fiscal_year)
                    ->where('total_marks_finalVerifier',$highest_score);
                })->get(); 
                
                $lowestScoreOrgs = Organization::where('province_id',$province)->whereHas('forms',function($query) use($lowest_score, $fiscal_year){
                    $query->finalVerified()
                    ->where('year',$fiscal_year)
                    ->where('total_marks_finalVerifier',$lowest_score);
                })->get();
        
                $topOrgs = Organization::where('province_id',$province)->whereHas('forms',function($q) use ($fiscal_year){
                    $q->where('year',$fiscal_year)
                    ->orderBy('total_marks_finalVerifier','DESC')
                    ->with('organization','subjectAreas')
                    ->take(10);
                })->get();
        
                $lowOrgs = Organization::where('province_id',$province)->whereHas('forms',function($q) use ($fiscal_year){
                    $q->where('year',$fiscal_year)
                    ->orderBy('total_marks_finalVerifier','ASC')
                    ->with('organization','subjectAreas')
                    ->take(10);
                })->get();

                $orgs = Organization::where('province_id',$province)->whereHas('forms',function($query) use ($fiscal_year){
                    $query->where('year',$fiscal_year)
                    ->where('status',1);
                })->get();
        
                $submittedFormOrgs = $orgs->count();
            
                $subjectAreas = SubjectArea::all();

                $total_marks = $this->totalMarks($subjectAreas,$forms,$published_forms);
            }

        }
        else
        {
            if(isset($district))
            {
                $organizations = Organization::where('district_id', $district)->get();

                $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
                    $query->where('district_id',$district);
                })->get();
                $forms = $published_forms->pluck('id');
                $published_forms = $published_forms->count();
    
                $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
                    $query->where('district_id',$district);
                })->max('total_marks_finalVerifier');
                
    
                $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
                    $query->where('district_id',$district);
                })->min('total_marks_finalVerifier');
    
                $average_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
                    $query->where('district_id',$district);
                })->avg('total_marks_finalVerifier');
    
                $highestScoreOrgs = Organization::where('district_id',$district)->whereHas('forms',function($query) use($highest_score, $fiscal_year){
                    $query->finalVerified()
                    ->where('year',$fiscal_year)
                    ->where('total_marks_finalVerifier',$highest_score);
                })->get(); 
                
                $lowestScoreOrgs = Organization::where('district_id',$district)->whereHas('forms',function($query) use($lowest_score, $fiscal_year){
                    $query->finalVerified()
                    ->where('year',$fiscal_year)
                    ->where('total_marks_finalVerifier',$lowest_score);
                })->get();
        
                $topOrgs = Organization::where('district_id',$district)->whereHas('forms',function($q) use ($fiscal_year){
                    $q->where('year',$fiscal_year)
                    ->orderBy('total_marks_finalVerifier','DESC')
                    ->with('organization','subjectAreas')
                    ->take(10);
                })->get();
        
                $lowOrgs = Organization::where('district_id',$district)->whereHas('forms',function($q) use ($fiscal_year){
                    $q->where('year',$fiscal_year)
                    ->orderBy('total_marks_finalVerifier','ASC')
                    ->with('organization','subjectAreas')
                    ->take(10);
                })->get();

                $orgs = Organization::where('district_id',$district)->whereHas('forms',function($query) use ($fiscal_year){
                    $query->where('year',$fiscal_year)
                    ->where('status',1);
                })->get();
        
                $submittedFormOrgs = $orgs->count();
            
                $subjectAreas = SubjectArea::all();

                $total_marks = $this->totalMarks($subjectAreas,$forms,$published_forms);
            }
            
        }
            
        $total_orgs = $organizations->count();
            
    
            return response([
                'organizations'=> $organizations,
                'provinces' => $provinces,
                'districts' => $districts,
                'total_orgs' => $total_orgs,
                'published_forms' => $published_forms,
                'highest_score' => $highest_score,
                'lowest_score' => $lowest_score,
                'average_score' => $average_score,
                'topOrgs' => $topOrgs,
                'lowOrgs' => $lowOrgs,
                'years' => $years,
                'subjectAreas' => $subjectAreas,
                'total_marks' =>$total_marks,
                ]);
    
        
    }

    public function organizationDetail(Request $request, Organization $organization)
    {

        $form = $organization->forms()->finalVerified()->where('year',$request->fiscal_year)->first();
        
        return $result = $this->detail($form, $organization);

    }

    public function filterOrg(Request $request)
    {
        $organization = Organization::where('id',$request->organization)->first();

        $form = $organization->forms()->finalVerified()->where('year',$request->fiscal_year)->first();
        
        return $result = $this->detail($form, $organization);
    }

    public function totalMarks($subjectAreas,$forms,$published_forms)
    {
        $total_marks = [];

        $subjectAreaTotal = 0;

        foreach($subjectAreas as $subjectArea)
        {
            $total = 0;

            $form_subject_area = FormSubjectArea::where('subject_area_id',$subjectArea->id)->whereIn('form_id',$forms)->get();
            
            foreach($form_subject_area as $item){
                $total = $item->marksByFinalVerifier + $total;
            }

            if($subjectArea->parameter)
            {

                foreach($subjectArea->parameters as  $parameter)
                {
                    $subjectAreaTotal = $parameter->options()->max('points') + $subjectAreaTotal;
                }
            }

            if($published_forms !== 0 && $subjectAreaTotal !== 0)
            {

                $percentage = ($total/($subjectAreaTotal*$published_forms))*100;
            }
            else
            {
                $percentage = 0;
            }
            
            array_push($total_marks,['subject_area'=>$subjectArea,'percentage'=>$percentage]);
        }

        return $total_marks;
    }
    
    public function detail($form, $organization)
    {
        $years = Form::finalVerified()->distinct()->pluck('year');

        if(isset($form))
        {
            $SA = SubjectArea::whereHas('forms',function($query) use ($form) {
                $query->where('form_id',$form->id);
            })->with(['forms' => function($query) use ($form) {
                $query->where('form_id',$form->id);
            }])->get();
    
            $SA_ids = $SA->pluck('id');
    
            $form_subject_areas = FormSubjectArea::where('form_id',$form->id)->whereIn('subject_area_id',$SA_ids)->get();
    
            $parameters = Parameter::whereHas('formSubjectAreas',function($query) use($form_subject_areas ,$form){
                $query->where('form_id',$form->id)
                ->whereIn('form_subject_area_id',$form_subject_areas);
            })->with(['formSubjectAreas'=>function($query) use ($form_subject_areas,$form){
                $query->where('form_id',$form->id)->whereIn('form_subject_area_id',$form_subject_areas);
            }])->get();

            return response([
                'form' => $form,
                'years' => $years,
                'organization' => $organization,
                'subject_areas' => $SA,
                'parameters' => $parameters,
            ]);
        }
        else
        {
            return response([
                'years' => $years,
                'organization' => $organization,
                'message' => 'Form not found',
            ]);
        }
        
    }
}
