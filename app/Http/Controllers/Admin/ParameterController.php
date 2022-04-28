<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Http\Requests\MassDestroyParameterRequest;
use App\SubjectArea;
use App\Parameter;
use App\Option;
use App\Document;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('parameter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameters = Parameter::all();

        return view('admin.parameters.index',compact('parameters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('parameter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject_areas = SubjectArea::all();
        $parameter = Parameter::latest()->first();
        $sort = ($parameter)?$parameter->sort + 5:1;

        return view('admin.parameters.create',compact('subject_areas','sort'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParameterRequest $request)
    {
        // dd($request->all());
        $request->validate([
            'addmore.*.title' => 'required',
            'addmore.*.points' => 'required',
            'addmore1.*.title' => 'required',
        ]);

        $data = [
            'title'             => $request->title,
            'subject_area_id'   => $request->subject_area_id,
            'sort'              => $request->sort,
            // 'slug'              =>$request->slug,
            'description'       => $request->description,
            'status'            => $request->status,
        ];
        // dd($data);
        $parameter = Parameter::create($data);

    
        foreach ($request->addmore as $key => $value) {
            // dd($value['title']);
            $option = Option::create([
                'title' => $value['title'],
                'points' => $value['points'],
                'parameter_id' => $parameter->id,
                'status' => $value['status']
            ]);
        }
// dd($option);
            
        
            foreach ($request->addmore1 as $key => $value) {
                // dd('here');dd($value['title']);
                Document::create([
                    'title' => $value['title'],
                    'parameter_id' => $parameter->id,
                    'status' => $value['status']
                ]);
            }
        

        return redirect()->route('admin.parameters.index')->with('message','New Parameter added successfully!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $parameter)
    {
        abort_if(Gate::denies('parameter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parameters.show', compact('parameter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Parameter $parameter)
    {
        abort_if(Gate::denies('parameter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject_areas = SubjectArea::all();

        return view('admin.parameters.edit',compact('parameter','subject_areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        // dd($request->all());
        $data = [
            'title'             => $request->title,
            'subject_area_id'   => $request->subject_area_id,
            'slug'              => $request->slug,
            'sort'              => $request->sort,
            'description'       => $request->description,
            'status'            => $request->status,
        ];
        // dd($data);
        $parameter->update($data);

        foreach($parameter->options as $option)
        {
            $option->delete();
        }

        if(isset($request->addmore))
        {

            foreach ($request->addmore as $key => $value) 
            {
                // dd($value['points']);
                
                if(isset($value['title']))
                {
                    Option::create([
                        'title' => $value['title'],
                        'points' => $value['points'],
                        'parameter_id' => $parameter->id,
                        'status' => $value['status']
                    ]);
    
                }
                
            }
        }

        foreach($parameter->documents as $document)
        {
            $document->delete();
        }

        if(isset($request->addmore1))
        {

            foreach ($request->addmore1 as $key => $value) 
            {
                // dd($value['status']);
                
                if(isset($value['title']))
                {
    
                    Document::create([
                        'title' => $value['title'],
                        'parameter_id' => $parameter->id,
                        'status' => $value['status']
                    ]);
                }
                
            }
        }

        return redirect()->route('admin.parameters.index')->with('message','Parameter details edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $parameter)
    {
        abort_if(Gate::denies('parameter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameter->delete();

        return back()->with('message','Parameter deleted successfully!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Parameter::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);

    }

    public function massDestroy(MassDestroyParameterRequest $request)
    {
        Parameter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function changeStatus(Request $request)
    {
        abort_if(Gate::denies('parameter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $parameter = Parameter::find($request->parameter_id);
        $parameter->status = $request->status;
        $parameter->save();
  
        return response()->json(['success'=>'Status changed successfully.']);
    }
}
