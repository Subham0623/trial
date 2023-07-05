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
use Carbon\Carbon;
use Pratiksh\Nepalidate\Facades\NepaliDate;


class HomeController
{
    public function index(){
        // dd($mytime = Carbon::now()->toArray());
        $organizations = Organization::with('province','district')->get();
        $total_orgs = $organizations->count();

        $districts = [];

        // $fiscal_year = Form::finalVerified()->latest()->pluck('year')->first();
        $fiscal_year = $this->currentFiscalYear();

        //If no forms are submitted in the fiscal year then the fiscal year that we calculated will not be included in the dropdown so we added the $fiscal_year to $years in the code below
        $years = Form::finalVerified()->distinct()->pluck('year');
        if(!$years->contains($fiscal_year)){
            $years = $years->merge($fiscal_year);
        }

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

        // dd($highestScoreOrg = $highestScoreOrgs->first());

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
        $subjectAreas = SubjectArea::active()->get();

        $ministry = Organization::where('type_id',1)->get();
        $total_ministry = $ministry->count();
        $department = Organization::where('type_id',2)->count();
        $districtOrg = Organization::where('type_id',3)->count();
        $ilaka = Organization::where('type_id',4)->count();

        $departments = [];
        $districtOrgs = [];
        $ilakas = [];

        $ministry_id = null;
        $department_id = null;
        $districtOrg_id = null;

        return view('home',
        compact('organizations','district','subjectAreas','provinces','districts','total_orgs','published_forms','highest_score','lowest_score','average_score','highestScoreOrgs','lowestScoreOrgs','topOrgs','lowOrgs','years','province','fiscal_year','submittedFormOrgs','forms','ministry','department','districtOrg','ilaka','departments','districtOrgs','ilakas','total_ministry','ministry_id','department_id','districtOrg_id','topOrgsForms','lowOrgsForms'));
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

    public function provinceDistricts(Request $request)
    {
        $province = Province::findOrFail($request->province);
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
        $current_fiscal_year = $this->currentFiscalYear();


        $fiscal_year = ($request->fiscal_year ? $request->fiscal_year : $current_fiscal_year);
        $province = $request->province;
        $district = $request->district;

        $provinces = Province::all();
        $districts = [];

        // dd($request->province);

        // $years = Form::finalVerified()->distinct()->pluck('year');

        //If no forms are submitted in the fiscal year then the fiscal year that we calculated will not be included in the dropdown so we added the $fiscal_year to $years in the code below
        $years = Form::finalVerified()->distinct()->pluck('year');
        if(!$years->contains($current_fiscal_year)){
            $years = $years->merge($current_fiscal_year);
        }

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
                // dd($highest_score);


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
        // else
        // {
        //     if(isset($district))
        //     {
        //         // dd('here');
        //         $organizations = Organization::where('district_id', $district)->get();

        //         $orgs = Organization::where('district_id', $district)->whereHas('forms',function($query) use ($fiscal_year){
        //             $query->where('year',$fiscal_year)
        //             ->where('status',1);
        //         })->get();

        //         $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
        //             $query->where('district_id',$district);
        //         })->get();

        //         $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
        //             $query->where('district_id',$district);
        //         })->max('total_marks_finalVerifier');
        //         // dd($highest_score);

        //         $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
        //             $query->where('district_id',$district);
        //         })->min('total_marks_finalVerifier');

        //         $average_score = Form::finalVerified()->where('year',$fiscal_year)->whereHas('organization',function($query) use($district){
        //             $query->where('district_id',$district);
        //         })->avg('total_marks_finalVerifier');

        //         $highestScoreOrgs = Organization::where('district_id',$district)->whereHas('forms',function($query) use($highest_score, $fiscal_year){
        //             $query->finalVerified()
        //             ->where('year',$fiscal_year)
        //             ->where('total_marks_finalVerifier',$highest_score);
        //         })->get();

        //         $lowestScoreOrgs = Organization::where('district_id',$district)->whereHas('forms',function($query) use($lowest_score, $fiscal_year){
        //             $query->finalVerified()
        //             ->where('year',$fiscal_year)
        //             ->where('total_marks_finalVerifier',$lowest_score);
        //         })->get();

        //         $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

        //         $topOrgs = [];
        //         foreach($topOrgsForms as $top) {
        //             $organization = Organization::where('id',$top->organization_id)->where('district_id',$district)->first();
        //         if(isset($organization)) {

        //             array_push($topOrgs,$organization);
        //         }
        //         }

        //         $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

        //         $lowOrgs = [];
        //         foreach($lowOrgsForms as $low) {
        //             $organization = Organization::where('id',$low->organization_id)->where('district_id',$district)->first();
        //             if(isset($organization)) {

        //                 array_push($lowOrgs,$organization);
        //             }
        //         }
        //     }

        // }
        //     // dd($districts);
        $total_orgs = $organizations->count();
        $forms = $published_forms->pluck('id');
        $published_forms = $published_forms->count();
        $subjectAreas = SubjectArea::active()->get();
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

        $form = $organization->forms()->finalVerified()->publish()->where('year',$fiscal_year)->first();

        $form_subject_area = $this->fiscalYear($fiscal_year,$organization,$form);
        // dd($form_subject_area);
        // dd($form->load('subjectAreas'));
        return view('admin.organizations.detail',compact('years','form','form_subject_area','organization','fiscal_year'));

    }

    public function filterOrg(Request $request)
    {
// dd($request->all());
        $organization = Organization::where('id',$request->organization)->first();

        $years = Form::finalVerified()->distinct()->pluck('year');

        $fiscal_year = $request->fiscal_year;
        $form_subject_area = [];
        $form = $organization->forms()->finalVerified()->publish()->where('year',$fiscal_year)->first();

        // dd($form);
        if(isset($form)){

            $selected_subjectareas = $form->subjectAreas()->orderBy('id','ASC')->get();
            $selected_subjectareas->pluck('id');

            $form_subject_area = FormSubjectArea::where('form_id',$form->id)->whereIn('subject_area_id',$selected_subjectareas->pluck('id'))->with('selected_subjectareas')->orderBy('subject_area_id')->get();

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

            $form_subject_area = FormSubjectArea::where('form_id',$form->id)->whereIn('subject_area_id',$selected_subjectareas->pluck('id'))->with('selected_subjectareas')->orderBy('subject_area_id')->get();

        }

    return $form_subject_area;
    }

    public function currentFiscalYear()
    {
        $date = toBS(Carbon::now());
        $arr = explode("-", $date);
        if($arr[1] <= 3)
        {
            $y = $arr[0]-1;
            $fiscal_year = $y.'/'.(substr($arr[0],-2));
        }
        else
        {
            $y = (substr($arr[0], -2))+1;
            $fiscal_year = $arr[0].'/'.$y;

        }
        return $fiscal_year;
    }

    public function childOrganizations(Request $request)
    {
        if(isset($request->ministry))
        {
            $departments = Organization::where('type_id',2)->where('organization_id',$request->ministry)->pluck('name','id');
            $districtOrgs = Organization::where('type_id',3)->where('organization_id',$request->ministry)->pluck('name','id');
            return ['departments'=>$departments,'districtOrgs'=>$districtOrgs];
        }
    }

    public function areas(Request $request)
    {
        if(isset($request->districtOrg))
        {
            $areas = Organization::where('organization_id',$request->districtOrg)->pluck('name','id');
            return $areas;
        }
    }

    public function filter2(Request $request)
    {
        $current_fiscal_year = $this->currentFiscalYear();

        $fiscal_year = ($request->fiscal_year ? $request->fiscal_year : $current_fiscal_year);

        $years = Form::finalVerified()->distinct()->pluck('year');
        if(!$years->contains($current_fiscal_year)){
            $years = $years->merge($current_fiscal_year);
        }

        if(isset($fiscal_year) && $request->ministry == null && $request->districtOrg == null && $request->department == null)
        {
            $organizations = Organization::with('province','district')->get();
            $total_orgs = $organizations->count();

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

            $ministry = Organization::where('type_id',1)->get();
            $total_ministry = $ministry->count();
            $department = Organization::where('type_id',2)->count();
            $districtOrg = Organization::where('type_id',3)->count();
            $ilaka = Organization::where('type_id',4)->count();
            $departments = [];
            $districtOrgs = [];

        }
        elseif(isset($request->ministry) && $request->districtOrg == null && $request->department == null)
        {
            $organizations = Organization::where('organization_id',$request->ministry)->get();
            $organizations = $organizations->push(Organization::findOrFail($request->ministry));
            $ids = $organizations->pluck('id');


            $orgs = Organization::whereIn('id',$ids)->whereHas('forms',function($query) use ($fiscal_year){
                $query->where('year',$fiscal_year)
                ->where('status',1);
            })->get();

            $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->get();

            $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->max('total_marks_finalVerifier');
            $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->min('total_marks_finalVerifier');
            $average_score = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->avg('total_marks_finalVerifier');

            $highestScoreOrgs = Organization::whereIn('id',$ids)->whereHas('forms',function($query) use($highest_score, $fiscal_year){
                $query->finalVerified()
                ->where('year',$fiscal_year)
                ->where('total_marks_finalVerifier',$highest_score);
            })->get();

            $lowestScoreOrgs = Organization::whereIn('id',$ids)->whereHas('forms',function($query) use($lowest_score, $fiscal_year){
                $query->finalVerified()
                ->where('year',$fiscal_year)
                ->where('total_marks_finalVerifier',$lowest_score);
            })->get();

            $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

            $topOrgs = [];
            foreach($topOrgsForms as $top) {
                $organization = Organization::find($top->organization_id);
            if(isset($organization)) {

                array_push($topOrgs,$organization);
            }
            }
        // dd($topOrgs);

            $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

            $lowOrgs = [];
            foreach($lowOrgsForms as $low) {
                $organization = Organization::find($low->organization_id);
            if(isset($organization)) {

                array_push($lowOrgs,$organization);
            }
            }
            $total_ministry = 1;

            $departments = Organization::where('type_id',2)->where('organization_id',$request->ministry)->get();
            $department = $departments->count();
            $districtOrgs = Organization::where('type_id',3)->where('organization_id',$request->ministry)->get();
            $districtOrg = $districtOrgs->count();
            $ilaka = Organization::where('type_id',4)->whereIn('organization_id',$districtOrgs->pluck('id'))->count();
        }
        else
        {
            $organizations = Organization::where('organization_id',$request->districtOrg ? $request->districtOrg : $request->department)->get();
            $organizations = $organizations->push(Organization::findOrFail($request->districtOrg ? $request->districtOrg : $request->department));
            $ids = $organizations->pluck('id');


            $orgs = Organization::whereIn('id',$ids)->whereHas('forms',function($query) use ($fiscal_year){
                $query->where('year',$fiscal_year)
                ->where('status',1);
            })->get();

            $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->get();

            $highest_score = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->max('total_marks_finalVerifier');
            $lowest_score = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->min('total_marks_finalVerifier');
            $average_score = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->avg('total_marks_finalVerifier');

            $highestScoreOrgs = Organization::whereIn('id',$ids)->whereHas('forms',function($query) use($highest_score, $fiscal_year){
                $query->finalVerified()
                ->where('year',$fiscal_year)
                ->where('total_marks_finalVerifier',$highest_score);
            })->get();

            $lowestScoreOrgs = Organization::whereIn('id',$ids)->whereHas('forms',function($query) use($lowest_score, $fiscal_year){
                $query->finalVerified()
                ->where('year',$fiscal_year)
                ->where('total_marks_finalVerifier',$lowest_score);
            })->get();

            $topOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->orderBy('total_marks_finalVerifier','DESC')->with('organization','subjectAreas')->take(10)->get();

            $topOrgs = [];
            foreach($topOrgsForms as $top) {
                $organization = Organization::find($top->organization_id);
            if(isset($organization)) {

                array_push($topOrgs,$organization);
            }
            }
        // dd($topOrgs);

            $lowOrgsForms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->orderBy('total_marks_finalVerifier','ASC')->with('organization','subjectAreas')->take(10)->get();

            $lowOrgs = [];
            foreach($lowOrgsForms as $low) {
                $organization = Organization::find($low->organization_id);
            if(isset($organization)) {

                array_push($lowOrgs,$organization);
            }
            }

                $department = ($request->districtOrg ? 0 : 1);
                $districtOrg = ($request->districtOrg ? 1 : 0);
                $ilaka = Organization::where('organization_id',$request->districtOrg ? $request->districtOrg : $request->department)->where('type_id',4)->count();
                $departments = Organization::where('type_id',2)->where('organization_id',$request->ministry)->get();
                $districtOrgs = Organization::where('type_id',3)->where('organization_id',$request->ministry)->get();
                $total_ministry = 1;

        }

        $total_orgs = $organizations->count();
        $forms = $published_forms->pluck('id');
        $published_forms = $published_forms->count();
        $subjectAreas = SubjectArea::active()->get();
        $submittedFormOrgs = $orgs->count();
        $ministry = Organization::where('type_id',1)->get();

        $ministry_id = $request->ministry;
        $department_id = $request->department;
        $districtOrg_id = $request->districtOrg;

        $html = view('home',compact('organizations','forms','subjectAreas','total_orgs','published_forms','highest_score','lowest_score','average_score','highestScoreOrgs','lowestScoreOrgs','topOrgs','lowOrgs','years','fiscal_year','submittedFormOrgs','ministry','department','districtOrg','departments','districtOrgs','total_ministry','ilaka','ministry_id','department_id','districtOrg_id'))->render();
        // dd($html);
        return response()->json(array(
            'success' => true,
            'html' => $html,
            ));
    }

    public function listOrganizations()
    {
        // dd(auth()->user()->roles);
        // $fiscal_year = Form::finalVerified()->latest()->pluck('year')->first();
        $fiscal_year = $this->currentFiscalYear();

        //If no forms are submitted in the fiscal year then the fiscal year that we calculated will not be included in the dropdown so we added the $fiscal_year to $years in the code below
        $years = Form::finalVerified()->distinct()->pluck('year');
        if(!$years->contains($fiscal_year)){
            $years = $years->merge($fiscal_year);
        }
        $published_forms = Form::ofUser()->finalVerified()->where('year',$fiscal_year)->get();

        $ministry = Organization::where('type_id',1)->ofUser()->get();
        // dd($published_forms);
        $departments = Organization::where('type_id',2)->ofUser()->get();;
        $districtOrgs = Organization::where('type_id',3)->ofUser()->get();;

        $ministry_id = $ministry->first()->id;
        $department_id = null;
        $districtOrg_id = null;

        return view('list-organizations',compact('fiscal_year','years','ministry','departments','districtOrgs','ministry_id','department_id','districtOrg_id','published_forms'));
    }

    public function filterListOrganizations(Request $request)
    {
        // dd($request->all());
        $ministry_id = $request->ministry;
        $department_id = $request->department;
        $districtOrg_id = $request->districtOrg;
        $current_fiscal_year = $this->currentFiscalYear();

        $fiscal_year = ($request->fiscal_year ? $request->fiscal_year : $current_fiscal_year);

        $years = Form::finalVerified()->distinct()->pluck('year');
        if(!$years->contains($current_fiscal_year)){
            $years = $years->merge($current_fiscal_year);
        }


        if(isset($fiscal_year) && $ministry_id == null && $department_id == null && $districtOrg_id == null)
        {
            $published_forms = Form::ofUser()->finalVerified()->where('year',$fiscal_year)->get();
        }
        elseif(isset($ministry_id) && $department_id == null && $districtOrg_id == null)
        {
            $organizations = Organization::where('organization_id',$ministry_id)->get();
            $organizations = $organizations->push(Organization::findOrFail($request->ministry));
            $ids = $organizations->pluck('id');

            $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->get();
        }
        else
        {
            $organizations = Organization::where('organization_id',$districtOrg_id ? $districtOrg_id : $department_id)->get();
            $organizations = $organizations->push(Organization::findOrFail($districtOrg_id ? $districtOrg_id : $department_id));
            $ids = $organizations->pluck('id');

            $published_forms = Form::finalVerified()->where('year',$fiscal_year)->whereIn('organization_id',$ids)->get();
        }

        $ministry = Organization::where('type_id',1)->ofUser()->get();
        $departments = Organization::where('type_id',2)->where('organization_id',$ministry_id)->ofUser()->get();
        $districtOrgs = Organization::where('type_id',3)->where('organization_id',$ministry_id)->ofUser()->get();

        $html = view('list-organizations',compact('ministry_id','department_id','districtOrg_id','ministry','published_forms','years','fiscal_year','departments','districtOrgs'))->render();
        return response()->json(array(
            'success' => true,
            'html' => $html,
            ));
    }


}
