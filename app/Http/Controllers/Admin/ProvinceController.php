<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Http\Requests\MassDestroyProvinceRequest;
use App\Province;
use App\District;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('province_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::with('organizations')->get();
        
        return view('admin.provinces.index',compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('province_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvinceRequest $request)
    {
        // dd($request->all());
        $request->validate([
            'addmore.*.name' => 'required|unique:districts',
        ]);
        $data = [
            'name' => $request->name,
        ];

        $province = Province::create($data);

    
        foreach ($request->addmore as $key => $value) {
            District::create([
                'name' => $value['name'],
                'province_id' => $province->id
            ]);
        }

        return redirect()->route('admin.provinces.index')->with('message','New Province added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        abort_if(Gate::denies('province_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinces.show',compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        abort_if(Gate::denies('province_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinces.edit',compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvinceRequest $request,Province $province)
    {
        // dd($request->all());
        $request->validate([
            'addmore.*.name' => 'required',
        ]);
        
        $data = [
            'name' => $request->name,
        ];
        // dd($data);
        $province->update($data);

        foreach($province->districts as $district)
        {
            $district->delete();
        }
        if($request->addmore)
        {
            foreach ($request->addmore as $key => $value) {
            // dd($value['name']);
            

                District::create([
                    'name' => $value['name'],
                    'province_id' => $province->id
                ]);
            
            }
        }
        return redirect()->route('admin.provinces.index')->with('message','Province details edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        abort_if(Gate::denies('province_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $province->delete();

        return back()->with('message','Province deleted successfully!');
    }

    public function massDestroy(MassDestroyProvinceRequest $request)
    {
        Province::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
