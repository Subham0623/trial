<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Form;
use App\Organization;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class FormController extends Controller
{
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
        if($roles->contains(5))
        {
            $verified_forms = Auth::user()->verifiedForms()->get();

            $forms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('verified_by',NULL)->get();

            $userOrg = auth::user()->organizations()->get()->first();
            $childOrgs = $userOrg->childOrganizations()->pluck('id');

            $orgForms = Form::whereIn('organization_id',$childOrgs)->get();

            $forms = $forms->merge($verified_forms)->merge($orgForms)->all();
            $organizations = Auth::user()->organizations()->get();
            // dd($forms);
            
        }
        elseif($roles->contains(4))
        {
            $audited_forms = Auth::user()->auditedForms()->get();
            
            $forms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            ->where('is_verified',1)
            ->where('audited_by',NULL)->get();

            $forms = $forms->merge($audited_forms)->all();
            $organizations = Auth::user()->organizations()->get();

            // dd($forms);  

        }
        elseif($roles->contains(6))
        {
            $final_verified_forms = Auth::user()->finalVerifiedForms()->get();
            
            $forms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            // ->where('is_verified',1)
            ->where('is_audited',1)
            ->where('final_verified_by',NULL)
            ->get();

            $forms = $forms->merge($final_verified_forms)->all();
            $organizations = Auth::user()->organizations()->get();

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
        return view('admin.forms.index',compact('forms','organizations','years','org','yr','roles'));
    }

   
    public function filter(Request $request)
    {
        // dd('here');
        // dd($request->organization);
        // dd(Auth::user());
        $roles = Auth::user()->roles()->pluck('id');

        if($roles->contains(1) || $roles->contains(2))
        {
            $organizations = Organization::all();
        }
        else
        {
            $organizations = Auth::user()->organizations()->get();
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
        if($roles->contains(5))
        {
            $verified_forms = Auth::user()->verifiedForms()->get();

            $forms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('verified_by',NULL)->get();

            $forms = $forms->merge($verified_forms)->pluck('id');
            return $forms;
            
        }
        elseif($roles->contains(4))
        {
            $audited_forms = Auth::user()->auditedForms()->get();
            
            $forms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            ->where('is_verified',1)
            ->where('audited_by',NULL)->get();

            $forms = $forms->merge($audited_forms)->pluck('id');
            return $forms;

            // dd($forms);  

        }
        elseif($roles->contains(6))
        {
            $final_verified_forms = Auth::user()->finalVerifiedForms()->get();
            
            $forms = Form::whereIn('organization_id',$orgs)
            // ->where('status',1)
            // ->where('is_verified',1)
            ->where('is_audited',1)
            ->where('final_verified_by',NULL)
            ->get();

            $forms = $forms->merge($final_verified_forms)->pluck('id');
            return $forms;

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
