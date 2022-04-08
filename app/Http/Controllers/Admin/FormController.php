<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Form;
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
        
        if($roles->contains(5))
        {
            $verified_forms = Auth::user()->verifiedForms()->get();

            $forms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('is_verified',0)->get();

            $forms = $forms->merge($verified_forms)->all();

            // dd($forms);
            
        }
        elseif($roles->contains(4))
        {
            $audited_forms = Auth::user()->auditedForms()->get();
            
            $forms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('is_verified',1)
            ->where('is_audited',0)->get();

            $forms = $forms->merge($audited_forms)->all();
            // dd($forms);
    
        }
        elseif($roles->contains(6))
        {
            $final_verified_forms = Auth::user()->finalVerifiedForms()->get();
            
            $forms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('is_verified',1)
            ->where('is_audited',1)
            ->where('final_verified',0)
            ->get();

            $forms = $forms->merge($final_verified_forms)->all();
            // dd($forms);
    
        }
        else
        {
            $forms = Form::all();
            $verified_forms=0; //what is this..?
        }

        return view('admin.forms.index',compact('forms'));
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
