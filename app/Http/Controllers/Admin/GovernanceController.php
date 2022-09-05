<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Governance;
use Symfony\Component\HttpFoundation\Response;

class GovernanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('governance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governances = Governance::all();

        return view('admin.governances.index', compact('governances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('governance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.governances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'title' => $request->title
        ];

        Governance::create($data);

        return redirect()->route('admin.governances.index')->with('message','New Governance added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Governance $governance)
    {
        abort_if(Gate::denies('governance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.governances.show', compact('governance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Governance $governance)
    {
        abort_if(Gate::denies('governance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.governances.edit', compact('governance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Governance $governance)
    {
        $data = [
            'title' => $request->title
        ];

        $governance->update($data);

        return redirect()->route('admin.governances.index')->with('message','Governance details edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governance $governance)
    {
        abort_if(Gate::denies('governance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governance->delete();

        return back()->with('message','Governance deleted successfully!');
    }
}
