<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Http\Requests\MassDestroyOrganizationRequest;
use App\Organization;
use App\Province;
use App\District;
use App\Type;
use App\Level;
use Gate;
use App\Governance;
use App\Imports\OrganizationsImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('organization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizations = Organization::with('province')->get();
        

        return view('admin.organizations.index',compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('organization_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::all();
        // $districts = District::all();
        $districts = [];
        $types = Type::all();
        $governances = Governance::all();
        $levels = Level::all()->pluck('title','id');

        return view('admin.organizations.create',compact('provinces','districts','types','governances','levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationRequest $request)
    {
        // dd($request->all());
        $data = [
            'name'              => $request->name,
            'contact'           => $request->contact,
            'province_id'       => $request->province,
            'district_id'       => $request->district,
            'address'           => $request->address,
            'type_id'           => $request->type,
            'organization_id'   => $request->organization, 
            'governance_id'     => $request->governance
        ];
        // dd($data);

        $organization = Organization::create($data);
        $organization->levels()->sync($request->input('levels', []));

        return redirect()->route('admin.organizations.index')->with('message','New Organization added successfully!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        abort_if(Gate::denies('organization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizations.show',compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        abort_if(Gate::denies('organization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::all();
        $districts = District::where('province_id',$organization->province_id)->get();
        $types = Type::all();
        $organizations = Organization::where('type_id',(($organization->type) ? $organization->type->type_id : ''))->get();
        $governances = Governance::all();
        $levels = Level::all()->pluck('title','id');

        return view('admin.organizations.edit',compact('provinces','districts','organization','types','organizations','governances','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        // dd($request->all());
        $data = [
            'name'              => $request->name,
            'contact'           => $request->contact,
            'province_id'       => $request->province,
            'district_id'       => $request->district,
            'address'           => $request->address,
            'type_id'           => $request->type,
            'organization_id'   => $request->organization,
            'governance_id'     => $request->governance
        ];

        $organization->update($data);
        $organization->levels()->sync($request->input('levels', []));
        return redirect()->route('admin.organizations.index')->with('message','Organization details edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        abort_if(Gate::denies('organization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organization->delete();

        return redirect()->route('admin.organizations.index')->with('message','Organization deleted successfully!');

    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Organization::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }

    public function massDestroy(MassDestroyOrganizationRequest $request)
    {
        Organization::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function organizationProvince(Request $request){
        // dd($request->province);
        $province = Province::findOrFail($request->province);
        return District::where('province_id',$request->province)->pluck('name','id');
        
    }

    public function import(Request $request) 
    {
        $request->validate([
                'file'=>'required|mimes:xlsx'
            ]);

            Excel::import(new OrganizationsImport,request()->file('file'));
        // try{

        // }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        //     $failures = $e->failures();
        //     // dd($failures);
             
        //       foreach ($failures as $key => $failure) { 
        //         $failure->row(); // row that went wrong
        //          $failure->attribute(); // 
        //         // $failure->errors() = $failure->errors()[0];
        //         // dd($failure);
        //         $new_error = $failure->errors();
                
        //          $failure->values(); // The values of the row that has failed.
        //          throw new \Maatwebsite\Excel\Validators\ValidationException($failure->getMessage()); 
                 
        //     }
        // }

        
           
        return redirect()->route('admin.organizations.index')->with('message','New Organizations added successfully!');
        
    }

    public function type(Request $request) 
    {
        $type = Type::find($request->type);
        return $organizations = Organization::where('type_id',$type->type_id)->pluck('name','id');
    }
}
