<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Form;
use App\Organization;
use Symfony\Component\HttpFoundation\Response;

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

        $forms = Form::with('user')->get();

        $organizations = Organization::all();

        $years = Form::groupBy('year')->pluck('year')->filter();
        // dd($years);
        
        return view('admin.forms.index',compact('forms','organizations','years'));
    }

    public function filter(Request $request)
    {
        // dd('here');
        // dd($request->organization);
        if((isset($request->organization)) && (isset($request->year)))
        {
            $forms = Form::where('organization_id',$request->organization)->where('year',$request->year)->get();
        }
        elseif((isset($request->organization)) && ($request->year == null))
        {
            $forms = Form::where('organization_id',$request->organization)->get();
        }
        else
        {
            $forms=Form::where('year',$request->year)->get();
        }

        $organizations = Organization::all();

        $years = Form::groupBy('year')->pluck('year')->filter();

        $html = view('admin.forms.index', compact('forms','organizations','years'))->render();
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
