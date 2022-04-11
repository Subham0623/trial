<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Organization;
use App\Province;
use App\District;
use App\Models\Authorization\User\User;
use Illuminate\Http\Request;
use App\Form;
use App\FormDetail;
use App\SubjectArea;
use App\FormSubjectArea;


class HomeController
{
    public function index(){
        // dd('here');
        $organizations = Organization::with('province','district')->get();
        $total_orgs = $organizations->count();

        $districts = District::all();

        $years = Form::finalVerified()->distinct()->pluck('year');
        $fiscal_year = Form::finalVerified()->latest()->pluck('year')->first();

        $provinces = Province::with('districts')->get();
        $province = null;
        $district = null;
        $orgs = Organization::whereHas('forms',function($query) use ($fiscal_year){
            $query->where('year',$fiscal_year)
            ->where('status',1);
        })->get();

        $submittedFormOrgs = $orgs->count();
        
        $published_forms = Form::finalVerified()->where('year',$fiscal_year)->get();

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

        $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

        $topOrgs = [];
        foreach($topOrgsForms as $top) {
            $organization = Organization::find($top->organization_id);
            if(isset($organization)) {

            array_push($topOrgs,$organization);
            }
        }
        // dd($topOrgs);
        $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

        $lowOrgs = [];
        foreach($lowOrgsForms as $low) {
            $organization = Organization::find($low->organization_id);
            if(isset($organization)) {

                array_push($lowOrgs,$organization);
            }
        }

        $forms = $published_forms->pluck('id');
        $published_forms = $published_forms->count();
        $subjectAreas = SubjectArea::all();

        return view('home',
        compact('organizations','district','subjectAreas','provinces','districts','total_orgs','published_forms','highest_score','lowest_score','average_score','highestScoreOrgs','lowestScoreOrgs','topOrgs','lowOrgs','years','province','fiscal_year','submittedFormOrgs','forms'));
    }
    
    // public function index()
    // {
    //     $provinces = Province::all();
    //     $districts = District::all();
    //     $organizations = Organization::all()->count();

    //     $auditors = User::wherehas('roles',function($query){
    //         $query->where('title','Auditor');
    //     })->count();

    //     $finalVerifiers = User::wherehas('roles',function($query){
    //         $query->where('title','Final Verifier');
    //     })->count();

    //     $draft = Form::where('status',0)->count();
    //     $submitted = Form::where('status',1)->count();
    //     $verified = Form::where('is_verified',1)->count();
    //     $audited = Form::where('is_audited',1)->count();
    //     $final_verified = Form::where('final_verified',1)->count();

    //     $highest_score = Form::where('final_verified',1)->max('total_marks_finalVerifier');
    //     $lowest_score = Form::where('final_verified',1)->min('total_marks_finalVerifier');
    //     $average_score = Form::where('final_verified',1)->avg('total_marks_finalVerifier');

    //     $highestScoreOrgs = Organization::whereHas('forms',function($query) use($highest_score){
    //         $query->where('final_verified',1)
    //         ->where('total_marks_finalVerifier',$highest_score);
    //     })->get();

    //     $lowestScoreOrgs = Organization::whereHas('forms',function($query) use($lowest_score){
    //         $query->where('final_verified',1)
    //         ->where('total_marks_finalVerifier',$lowest_score);
    //     })->get();

        


        

    //     // $org = Organization::where('district_id',$district_id)->get();
    //     return view('home',compact('organizations','provinces','districts','auditors','finalVerifiers','draft','submitted','verified','final_verified','audited'));
    // }

    public function get_notifications(){
        return Auth::user()->unreadNotifications;
    }

    public function show_notifications($id){
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['url']);
        }
    }

    public function read_all_notifications()
    {
        Auth::user()->unreadNotifications()->get()->map(function($n) {
            $n->markAsRead();
        });
        return back();
    }

    public function list(Request $request)
    {
        $province = Province::findOrFail($request->province);
        
        $organizations = Organization::where('province_id',$request->province)->with('province','district')->get();
        
        return $organizations;
        
    }

    public function district(Request $request)
    {
        $district = District::findOrFail($request->district);
        
        $organizations = Organization::where('district_id',$request->district)->with('district','province')->get();
        
        return $organizations;
        
    }

    public function provinceDistrict($id)
    {
        $province = Province::findOrFail($id);
        $districts = $province->districts()->pluck('name','id');
        return $districts;

    }

    
   
    /**
     * requestIf the province and district are set, return organizations where province and district are equal
     * to the request. If only province is set, return organizations where province is equal to the
     * request. If only district is set, return organizations where district is equal to the 
     * 
     * @param Request request 
     */
    public function search(Request $request)
    {
        // dd($request->all());

        if((isset($request->province)) && (isset($request->district)))
        {
            $organizations = Organization::where('province_id',$request->province)->where('district_id',$request->district)->get();
            return $organizations;
        }
        elseif((isset($request->province)) && $request->district == NULL)
        {
            $organizations = Organization::where('province_id',$request->province)->get();
            return $organizations;
        }
        else
        {
            $organizations = Organization::where('district_id',$request->district)->get();
            return $organizations;
        }
       
    }

    public function filter(Request $request)
    {

        $fiscal_year = ($request->fiscal_year ? $request->fiscal_year : Form::finalVerified()->latest()->pluck('year')->first());
        $province = $request->province;
        $district = $request->district;

        $provinces = Province::all();
        $districts = District::all();

        // dd($request->province);

        $years = Form::finalVerified()->distinct()->pluck('year');
        // $fiscal_year = Form::finalVerified()->latest()->pluck('year')->first();

        if((isset($fiscal_year)) && ($province == null) && ($district == null))
        {
            $organizations = Organization::with('province','district')->get();

            $orgs = Organization::whereHas('forms',function($query) use ($fiscal_year){
                $query->where('year',$fiscal_year)
                ->where('status',1);
            })->get();

            $published_forms = Form::finalVerified()->where('year',$fiscal_year)->get();
    
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
    
            $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

            $topOrgs = [];
            foreach($topOrgsForms as $top) {
                $organization = Organization::find($top->organization_id);
            if(isset($organization)) {

                array_push($topOrgs,$organization);
            }
            }
        // dd($topOrgs);
            
            $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

            $lowOrgs = [];
            foreach($lowOrgsForms as $low) {
                $organization = Organization::find($low->organization_id);
            if(isset($organization)) {

                array_push($lowOrgs,$organization);
            }
            }            
        }
        
        if(isset($province))
        {
            $districts = District::where('province_id',$province)->get();
            if(isset($district))
            {

                $organizations = Organization::where('province_id', $province)->where('district_id', $district)->get();

                $orgs = Organization::where('province_id',$province)->where('district_id', $district)->whereHas('forms',function($query) use ($fiscal_year){
                    $query->where('year',$fiscal_year)
                    ->where('status',1);
                })->get();

                $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province, $district){
                    $query->where('province_id',$province)
                    ->where('district_id',$district);
                })->get();
    
                $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province, $district){
                    $query->where('province_id',$province)
                    ->where('district_id',$district);
                })->max('total_marks_finalVerifier');
                dd($highest_score);
                
    
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
        
                $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

                $topOrgs = [];
                foreach($topOrgsForms as $top) {
                    $organization = Organization::where('id',$top->organization_id)->where('province_id',$province)->where('district_id',$district)->first();
                    if(isset($organization)) {
                    
                        array_push($topOrgs,$organization);
                    }
                }
                // dd($topOrgs);
                $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

                $lowOrgs = [];
                foreach($lowOrgsForms as $low) {
                    $organization = Organization::where('id',$low->organization_id)->where('province_id',$province)->where('district_id',$district)->first();
                    if(isset($organization)) {
                    
                        array_push($lowOrgs,$organization);
                    }
                }
            }
            else
            {
                // dd('here');
                $organizations = Organization::where('province_id', $province)->get();

                $orgs = Organization::where('province_id',$province)->whereHas('forms',function($query) use ($fiscal_year){
                    $query->where('year',$fiscal_year)
                    ->where('status',1);
                })->get();

                $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($province){
                    $query->where('province_id',$province);
                })->get();
    
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
        
                $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();
// dd($topOrgsForms);
                $topOrgs = [];
                foreach($topOrgsForms as $top) {
                    $organization = Organization::where('id',$top->organization_id)->where('province_id',$province)->first();
                    // dd($organization);
                    if(isset($organization)){

                        array_push($topOrgs,$organization);
                    }
                }
                // dd($topOrgs);
                $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

                $lowOrgs = [];
                foreach($lowOrgsForms as $low) {
                    $organization = Organization::where('id',$low->organization_id)->where('province_id',$province)->first();
                    if(isset($organization)){

                        array_push($lowOrgs,$organization);
                    }
                }
            }

        }
        else
        {
            if(isset($district))
            {
                // dd('here');
                $organizations = Organization::where('district_id', $district)->get();

                $orgs = Organization::where('district_id', $district)->whereHas('forms',function($query) use ($fiscal_year){
                    $query->where('year',$fiscal_year)
                    ->where('status',1);
                })->get();

                $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
                    $query->where('district_id',$district);
                })->get();
    
                $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
                    $query->where('district_id',$district);
                })->max('total_marks_finalVerifier');
                // dd($highest_score);
    
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
        
                $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

                $topOrgs = [];
                foreach($topOrgsForms as $top) {
                    $organization = Organization::where('id',$top->organization_id)->where('district_id',$district)->first();
                if(isset($organization)) {
                    
                    array_push($topOrgs,$organization);
                }
                }
                
                $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

                $lowOrgs = [];
                foreach($lowOrgsForms as $low) {
                    $organization = Organization::where('id',$low->organization_id)->where('district_id',$district)->first();
                    if(isset($organization)) {
                    
                        array_push($lowOrgs,$organization);
                    }
                }
            }
            
        }
            // dd($districts);
        $total_orgs = $organizations->count();
        $forms = $published_forms->pluck('id');
        $published_forms = $published_forms->count();
        $subjectAreas = SubjectArea::all();
        $submittedFormOrgs = $orgs->count();

        $html = view('home',compact('organizations','forms','subjectAreas','provinces','districts','total_orgs','published_forms','highest_score','lowest_score','average_score','highestScoreOrgs','lowestScoreOrgs','topOrgs','lowOrgs','years','province','fiscal_year','submittedFormOrgs','district'))->render();
        // dd($html);
        return response()->json(array(
            'success' => true,
            'html' => $html,
            'province' => $province,
            'district' => $district,
        ));
    
        
    }

    public function organizationDetail(Request $request, Organization $organization)
    {

        $years = Form::finalVerified()->distinct()->pluck('year');

        $fiscal_year = Form::finalVerified()->latest()->pluck('year')->first();

        $form = $organization->forms()->finalVerified()->where('year',$fiscal_year)->first();

        $form_subject_area = $this->fiscalYear($fiscal_year,$organization,$form);
        // dd($form_subject_area);
        
        return view('admin.organizations.detail',compact('years','form','form_subject_area','organization','fiscal_year'));
        
    }

    public function filterOrg(Request $request)
    {
// dd($request->all());
        $organization = Organization::where('id',$request->organization)->first();

        $years = Form::finalVerified()->distinct()->pluck('year');

        $fiscal_year = $request->fiscal_year;
        $form_subject_area = [];
        $form = $organization->forms()->finalVerified()->where('year',$fiscal_year)->first();

        // dd($form);
        if(isset($form)){

            $selected_subjectareas = $form->subjectAreas()->orderBy('id','ASC')->get();
            $selected_subjectareas->pluck('id');

            $form_subject_area = FormSubjectArea::where('form_id',$form->id)->whereIn('subject_area_id',$selected_subjectareas->pluck('id'))->orderBy('subject_area_id')->get();
            
        }
        

        $html = view('admin.organizations.detail',compact('years','form','form_subject_area','organization','fiscal_year'))->render();
        // dd($html);
        return response()->json(array(
            'success' => true,
            'html' => $html,
        ));
        
    }

    public function fiscalYear($fiscal_year,$organization,$form)
    {

        
        $form_subject_area = [];
        if(isset($form)){

            $selected_subjectareas = $form->subjectAreas()->orderBy('id','ASC')->get();
            $selected_subjectareas->pluck('id');

            $form_subject_area = FormSubjectArea::where('form_id',$form->id)->whereIn('subject_area_id',$selected_subjectareas->pluck('id'))->orderBy('subject_area_id')->get();
            
        }
        
    return $form_subject_area;
    }

    
}
