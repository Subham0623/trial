<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Form;
use App\SubjectArea;
use App\Parameter;
use App\Option;
use App\Organization;
use App\Models\Authorization\User\User;
use App\FormDetail;
use App\FormSubjectArea;
use Illuminate\Http\Request;
use DB;

class HomeApiController extends Controller
{
    public function form()
    {
        $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
        $selected_options = [];
        return response([
            'subject_areas' => $subject_areas,
            'selected_options' => $selected_options,
        ]);
    }

    public function profile()
    {
        $user = Auth::user()->with('roles.permissions','organization')->get();
        return response(['user'=>$user]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'year' => $request->year,
        ];

        $form = Form::create($data);
        // dd($form);
        $form_subject_area = FormSubjectArea::create([
            'form_id' => $form->id,
            'subject_area_id' => $request->subject_area,
        ]);

        foreach($request->parameters as $parameter )
        {   
            if(isset($parameter['option']['id']))
            {
                $opt = Option::find($parameter['option']['id']);
                $form_detail = FormDetail::create([
                    'form_subject_area_id' => $form_subject_area->id,
                    'parameter_id' => $parameter['id'],
                    'remarks' => $parameter['remarks'],
                    'option_id' => $opt->id,
                    'marks' => $opt->points,
                ]);  
            }
        }

        $total = $form_subject_area->parameters->sum('pivot.marks');
        $form_subject_area->update([
            'marks'=> $total
        ]);

        $total_marks = $form->subjectAreas->sum('pivot.marks');
        $form->total_marks = $total_marks;
        $form->save();

        return response([
            'message'=>'Form saved successfully',
            'form_id'=>$form->id
        ],201);
    }

    public function fileUpload(Request $request)
    {
        // dd($request->file('file'));
        // $uploaded_file = $request->file('file')->store('tmp/documents/');
        // return response(['result'=>$uploaded_file]);
        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $path = storage_path('tmp/documents');
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ],200);
    }

    public function test(Request $request)
    {
        // dd($request->all());
        $form = Form::findOrFail($request->id)->where('user_id',Auth::user()->id)->first();
        $form_options = $form->options()->pluck('option_id');


        
            // $parameters = Parameter::where(['options'=>function($query) use($form_options){
            //     $query->whereIn('id',$form_options)->put('status',true);
            // }])->with('options')->get();
        
        // dd($options);
        // $subject_areas = SubjectArea::with(['parameters.options'=>function($query) use($form_option){
        //        $query->where('id',$form_option);
        //     }])->get();
        
            // $options = Option::where('id',1)->put('status',1);

        
        // dd($options);
        // 


        $parameters = Parameter::whereHas('options',function($query) use($form_options){
            $query->whereIn('id',$form_options);
        })->with('options')->get()->put('status',1);

        
        return response(['parameters' => $parameters]);
    }

    public function edit(Form $form)
    {
        $selected_options = [];
        // dd($user = Auth::user()->load('forms.subjectAreas.options'));
        if($form) {
            $selected_subjectareas = $form->subjectAreas()->pluck('form_id');
            $selected_options = FormDetail::whereIn('form_subject_area_id', $selected_subjectareas)->with('feedbacks')->get();
    
        }
        
        $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
        
        return response([
            'subject_areas' => $subject_areas,
            'selected_options' => $selected_options,
        ]);
    }

    public function update(Request $request, Form $form)
    {
        $user = Auth::user();
        
        $form = Form::findOrFail($form->id);
        
        if(isset($form)){
            $form_subject_area = FormSubjectArea::updateOrCreate([
                'form_id' => $form->id,
                'subject_area_id' => $request->subject_area,
            ]);

            foreach($request->parameters as $parameter )
            {   
                if(isset($parameter['option']['id'])) {
                    $opt = Option::find($parameter['option']['id']);
                    $form_detail = FormDetail::updateOrCreate([
                        'form_subject_area_id' => $form_subject_area->id,
                        'parameter_id' => $parameter['id'],
                    ],
                    [
                        'remarks' => $parameter['remarks'],
                        'option_id' => $opt->id,
                        'marks' => $opt->points,
                    ]);  
                }
            }

            $total = $form_subject_area->parameters->sum('pivot.marks');
            $form_subject_area->update([
                'marks'=> $total
            ]);

            $total_marks = $form->subjectAreas->sum('pivot.marks');
            $form->total_marks = $total_marks;
            $form->save();

            return response([
                'message'=>'Form saved successfully',
                'form_id'=>$form->id
            ],201);
        }

        

        
        return response([
            'message'=>'Form not found',
        ],422);
    }

    public function submit(Form $form)
    {
        $form->status = 1;
        $form->save();
        // dd($form);
        
        return response()->json(['message'=>'Form submitted successfully'],200);
    }
}
