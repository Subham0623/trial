<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Form;
use App\Organization;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Carbon\Carbon;
use Pratiksh\Nepalidate\Facades\NepaliDate;

class FormController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $form = Form::latest()->first();

        $roles = Auth::user()->roles()->pluck('id');
        $orgs = Auth::user()->organizations()->pluck('id');
        $years = Form::distinct()->pluck('year');
        $org = 0;
        $yr = 0;
        $forms = [];
        $organizations = [];

        $fiscal_year = $this->currentFiscalYear();

        if($roles->contains(5))
        {
            $verified_forms = Auth::user()->verifiedForms()->get();

            $orgForms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('verified_by',NULL)->get();

            $forms = $orgForms->merge($verified_forms);



            foreach(Auth::user()->organizations as $organization)
            {
                foreach($organization->childOrganizations as $child)
                {
                    $forms = $forms->merge($child->forms);
                }
                $organizations = Auth::user()->organizations->merge($organization->childOrganizations);
            }
            // dd($forms);

        }
        elseif($roles->contains(4))
        {
            $audited_forms = Auth::user()->auditedForms()->get();

            $orgForms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            ->where('is_verified',1)
            ->where('audited_by',NULL)->get();

            $forms = $orgForms->merge($audited_forms);

            $organizations = Auth::user()->organizations;

            // foreach(Auth::user()->organizations as $organization)
            // {
            //     foreach($organization->childOrganizations as $child)
            //     {
            //         $forms = $forms->merge($child->forms);
            //     }
            //     $organizations = Auth::user()->organizations->merge($organization->childOrganizations);
            // }

            // dd($forms);

        }
        elseif($roles->contains(6))
        {
            $final_verified_forms = Auth::user()->finalVerifiedForms()->get();

            $orgForms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            // ->where('is_verified',1)
            ->where('is_audited',1)
            ->where('final_verified_by',NULL)
            ->get();

            $forms = $orgForms->merge($final_verified_forms);

            $organizations = Auth::user()->organizations;

            // foreach(Auth::user()->organizations as $organization)
            // {
            //     foreach($organization->childOrganizations as $child)
            //     {
            //         $forms = $forms->merge($child->forms);
            //     }

            //     $organizations = Auth::user()->organizations->merge($organization->childOrganizations);
            // }

            // dd($forms);

        }
        elseif($roles->contains(1) || $roles->contains(2))
        {
            $forms = Form::all();
            $organizations = Organization::all();

        }
        else
        {
            $forms = [];
            $organizations = Organization::all();
        }
        
        return view('admin.forms.index',compact('forms','organizations','years','org','yr','roles','fiscal_year'));
    }


    public function filter(Request $request)
    {
        // dd('here');
        // dd($request->organization);
        // dd(Auth::user());
        $organizations = [];
        $roles = Auth::user()->roles()->pluck('id');

        if($roles->contains(1) || $roles->contains(2))
        {
            $organizations = Organization::all();
        }
        elseif($roles->contains(4) || $roles->contains(6))
        {
            $organizations = Auth::user()->organizations;
        }
        else
        {
            // $organizations = Auth::user()->organizations()->get();
            foreach(Auth::user()->organizations as $organization)
            {
                $organizations = Auth::user()->organizations->merge($organization->childOrganizations);
                // dd($organizations);
            }
        }

        $org = $request->organization;
        $yr = $request->year;
        if((isset($request->organization)) && (isset($request->year)))
        {
            $final_forms = $this->forms($roles,$organizations);
            $forms = Form::whereIn('id',$final_forms)->where('organization_id',$request->organization)->where('year',$request->year)->get();
            // dd($forms);
        }
        elseif((isset($request->organization)) && ($request->year == null))
        {
            $final_forms = $this->forms($roles,$organizations);
            $forms = Form::whereIn('id',$final_forms)->where('organization_id',$request->organization)->get();
        }
        else
        {
            $final_forms = $this->forms($roles,$organizations);
            $forms = Form::whereIn('id',$final_forms)->where('year',$request->year)->get();
        }

        $years = Form::groupBy('year')->pluck('year')->filter();
        $html = view('admin.forms.index', compact('forms','organizations','years','yr','org','roles'))->render();
        // dd($html);
        return response()->json(array(
            'success' => true,
            'html' => $html,
        ));

    }

    public function changePublish(Request $request)
    {
        abort_if(Gate::denies('form_publish'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $form = Form::find($request->form_id);
        $form->publish = $request->publish;
        $form->save();

        return response()->json(['success'=>'Publish status changed successfully.']);
    }

    public function forms($roles,$organizations)
    {
        $orgs = $organizations->pluck('id');
        $forms = [];
        if($roles->contains(5))
        {
            $verified_forms = Auth::user()->verifiedForms()->get();

            $orgForms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('verified_by',NULL)->get();

            $forms = $orgForms->merge($verified_forms);

            foreach(Auth::user()->organizations as $organization)
            {
                foreach($organization->childOrganizations as $child)
                {
                    $forms = $forms->merge($child->forms);
                }
            }

            return $forms->pluck('id');

        }
        elseif($roles->contains(4))
        {
            $audited_forms = Auth::user()->auditedForms()->get();

            $orgForms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            ->where('is_verified',1)
            ->where('audited_by',NULL)->get();

            $forms = $orgForms->merge($audited_forms);

            // foreach(Auth::user()->organizations as $organization)
            // {
            //     foreach($organization->childOrganizations as $child)
            //     {
            //         $forms = $forms->merge($child->forms);
            //     }
            // }

            return $forms->pluck('id');

            // dd($forms);

        }
        elseif($roles->contains(6))
        {
            $final_verified_forms = Auth::user()->finalVerifiedForms()->get();

            $orgForms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            // ->where('is_verified',1)
            ->where('is_audited',1)
            ->where('final_verified_by',NULL)
            ->get();

            $forms = $orgForms->merge($final_verified_forms);

            // foreach(Auth::user()->organizations as $organization)
            // {
            //     foreach($organization->childOrganizations as $child)
            //     {
            //         $forms = $forms->merge($child->forms);
            //     }
            // }

            return $forms->pluck('id');
            //returns the forms of the organization as well as all its child organizations

        }
        elseif($roles->contains(1) || $roles->contains(2))
        {
             $forms = Form::pluck('id');
             return $forms;

        }
        else
        {
            return $forms = null;
        }
    }


    public function verifiedForms(Request $request)
    {

        $user = Auth::user();
        $organizations = $user->organizations;
        $roles = $user->roles()->pluck('id');
        $years = Form::distinct()->pluck('year');
        $org = 0;
        $yr = 0;


        if($roles->contains(5))
        {
            if($request->value == 1)
            {

                $forms = $user->verifiedForms()->get();
            }
            elseif($request->value == 2)
            {
                $forms = Form::whereIn('organization_id',$organizations->pluck('id'))
                    ->where('status',1)
                    ->where('verified_by',NULL)->get();
            }
            else
            {
                // $forms = new \Illuminate\Database\Eloquent\Collection;
                $forms = collect();
                foreach($organizations as $org)
                {
                    foreach($org->childOrganizations as $child)
                    {

                        // dd($forms);
                        $forms = $forms->merge($child->forms);
                    }
                }
                // dd($forms);
            }

        }

        foreach($organizations as $organization)
        {
            $organizations = Auth::user()->organizations->merge($organization->childOrganizations);
        }

        $html = view('admin.forms.index', compact('forms','organizations','years','yr','org','roles'))->render();
        // dd($html);
        return response()->json(array(
            'success' => true,
            'html' => $html,
        ));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
