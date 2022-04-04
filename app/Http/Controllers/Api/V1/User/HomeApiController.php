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
use App\Feedback;
use App\FormSubjectArea;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

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
        $user = Auth::user()->load(['roles.permissions','organizations']);
        
        return response(['user'=>$user]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user_organization = $user->organizations->first();
        $data = [
            'user_id' => $user->id,
            'year' => $request->year,
            'organization_id' => $user_organization->id,
        ];

        $form = Form::create($data);
        // dd($form);
        $form_subject_area = FormSubjectArea::create([
            'form_id' => $form->id,
            'subject_area_id' => $request->subject_area,
        ]);

        foreach($request->parameters as $parameter )
        {   
            if($parameter['is_applicable'] == 0)
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
                        'is_applicable' => $parameter['is_applicable'],
                    ]);  
                }
            }
            else
            {
                $form_detail = FormDetail::create([
                    'form_subject_area_id' => $form_subject_area->id,
                    'parameter_id' => $parameter['id'],
                    'remarks' => $parameter['remarks'],
                    'is_applicable' => $parameter['is_applicable'],
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
        $organizations = Organization::whereHas('users',function($query){
            $query->where('id',Auth::user()->id);
        })->pluck('id');

        
        $selected_options = [];
        
        if($form) 
        {
            if($organizations->contains($form->organization_id))
            {
                $selected_options = $this->selectedOptions($form);
                
                $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
                
                return response([
                    'subject_areas' => $subject_areas,
                    'selected_options' => $selected_options,
                    'form_details' => $form->load('organization'),
                ]);
            }
            else
            {
                return response([
                    'message'=>'Access denied',
                ],403);
            }
        }
        else
        {
            return response([
                'message'=>'Form not found',
            ],422);
        }
        

    }

    public function update(Request $request, Form $form)
    {        
        $user = Auth::user();
        $roles = $user->roles->pluck('id');
        $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
        
        
        $form = Form::findOrFail($form->id);
        
        // dd('here');
        if(isset($form)){

            $form_subject_area = FormSubjectArea::updateOrCreate([
                'form_id' => $form->id,
                'subject_area_id' => $request->subject_area,
            ]);
            
            if($request->parameters)
            {
                
                foreach($request->parameters as $parameter )
                {   
                    $form_detail = FormDetail::where('form_subject_area_id',$form_subject_area->id)->where('parameter_id',$parameter['id'])->first();
                    
                    if(isset($form_detail))
                    {

                        if($form_detail->is_applicable == $parameter['is_applicable'])
                        {
        
                            if($parameter['is_applicable'] == 0) //0 means applicable and 1 means not applicable
                            {
        
                                if(isset($parameter['option']['id'])) {
                                    $opt = Option::findorFail($parameter['option']['id']);
                                    if($roles->contains(2) && ($user->id == $form->user_id))
                                    {
                                        $form_detail->update([
                                            'remarks' => $parameter['remarks'],
                                            'is_applicable' => $parameter['is_applicable'],
                                            'option_id' => $opt->id,
                                            'marks' => $opt->points,
                                        ]);
                                    
                                        $form->update([
                                            'updated_by'=>$user->id
                                        ]);
                                    }
                                    elseif($roles->contains(5))
                                    {
                                        if($form->user_id == $user->id)
                                        {
                                            $form_detail->update([
                                                'remarks' => $parameter['remarks'],
                                                'is_applicable' => $parameter['is_applicable'],
                                                'option_id' => $opt->id,
                                                'marksByVerifier' => $opt->points,
                                            ]); 
                                            $form->update([
                                                'updated_by'=>$user->id
                                            ]);
    
                                        }
                                        else
                                        {
                                            $form_detail->update([
                                                'option_id' => $opt->id,
                                                'marksByVerifier' => $opt->points,
                                            ]); 
                                            $form->update([
                                                'verified_by'=>$user->id
                                            ]);
                                        }
                                        
                                    }
                                    elseif($roles->contains(4))
                                    {
                                        $form_detail->update([
                                            'option_id' => $opt->id,
                                            'marksByAuditor' => $opt->points,
                                        ]); 
                                        $form->update([
                                            'audited_by'=>$user->id
                                        ]);
                                    }
                                    elseif($roles->contains(6))
                                    {
                                        $form_details->update([
                                            'option_id' => $opt->id,
                                            'marksByFinalVerifier' => $opt->points,
                                        ]); 
                                        $form->update([
                                            'final_verified_by'=>$user->id
                                        ]);
                                    }
                                    else
                                    {
                                        return response(['message'=>'access denied'],403);
                                    }
                                    
                                    
                                }
                            }
                            else
                            {
                                if($form->user_id == $user->id)
                                {
                                    $form_detail = FormDetail::updateOrCreate([
                                        'form_subject_area_id' => $form_subject_area->id,
                                        'parameter_id' => $parameter['id'],
                                    ],
                                    [
                                        'remarks' => $parameter['remarks'],
                                        'option_id' => null,
                                        'marks' => null,
                                        'is_applicable' => $parameter['is_applicable'],
                                    ]); 
                                    $form->update([
                                        'updated_by'=>$user->id
                                    ]);
                                }
                                else
                                {
                                    return response(['message'=>'access denied']);
                                }
                            }
                        }
                        else
                        {
                            if($form->user_id == $user->id)
                            {
                                if($parameter['is_applicable'] == 0)
                                {
                                    if(isset($parameter['option']['id']))
                                    {
                                        $opt = Option::findorFail($parameter['option']['id']);
        
                                        $form_detail->update([
                                            'remarks' => $parameter['remarks'],
                                            'is_applicable' => $parameter['is_applicable'],
                                            'option_id' => $opt->id,
                                            'marks' => $opt->points,
                                        ]);
                                        $form->update([
                                            'updated_by' => $user->id, 
                                        ]);
                                    }
                                }
                                else
                                {
                                    $form_detail->update([
                                        'remarks' => $parameter['remarks'],
                                        'option_id' => null,
                                        'marks' => null,
                                        'is_applicable' => $parameter['is_applicable'],
                                    ]);
                                    $form->update([
                                        'updated_by' => $user->id, 
                                    ]);
                                }
                            }
                            else
                            {
                                return response(['message'=>'access denied'],403);
                            }
                        }
                    }
                    else
                    {
                        if($form->user_id == $user->id)
                        {

                            if($parameter['is_applicable'] == 0)
                            {
                                if(isset($parameter['option']['id']))
                                {
                                    $opt = Option::findorFail($parameter['option']['id']);
                                    $form_detail = FormDetail::create([
                                        'form_subject_area_id' => $form_subject_area->id,
                                        'parameter_id' => $parameter['id'],
                                        'remarks' => $parameter['remarks'],
                                        'option_id' => $opt->id,
                                        'marks' => $opt->points,
                                        'is_applicable' => $parameter['is_applicable'],
                                    ]);  
                                }
                            }
                            else
                            {
                                $form_detail = FormDetail::create([
                                    'form_subject_area_id' => $form_subject_area->id,
                                    'parameter_id' => $parameter['id'],
                                    'remarks' => $parameter['remarks'],
                                    'is_applicable' => $parameter['is_applicable'],
                                ]);
                            }
                        }
                        else{
                            return response(['message'=>'access denied']);
                        }
                    }
                }
    
                $total = $form_subject_area->parameters->sum('pivot.marks');
                $totalByVerifier = $form_subject_area->parameters->sum('pivot.marksByVerifier');
                $totalByAuditor = $form_subject_area->parameters->sum('pivot.marksByAuditor');
                $totalByFinalVerifier = $form_subject_area->parameters->sum('pivot.marksByFinalVerifier');
    
                $form_subject_area->update([
                    'marks'=> $total,
                    'marksByVerifier'=> $totalByVerifier,
                    'marksByAuditor'=> $totalByAuditor,
                    'marksbyFinalVerifier'=> $totalByFinalVerifier,
                ]);
    
                $total_marks = $form->subjectAreas->sum('pivot.marks');
                $total_marks_verifier = $form->subjectAreas->sum('pivot.marksByVerifier');
                $total_marks_auditor = $form->subjectAreas->sum('pivot.marksByAuditor');
                $total_marks_finalVerifier = $form->subjectAreas->sum('pivot.marksByFinalVerifier');
    
                $form->update([
                    'total_marks' => $total_marks,
                    'total_marks_verifier' => $total_marks_verifier,
                    'total_marks_auditor' => $total_marks_auditor,
                    'total_marks_finalVerifier' => $total_marks_finalVerifier,
                ]);
    
                $selected_options = $this->selectedOptions($form);

                return response([
                    'message'=>'Form updated successfully',
                    'form_details' => $form->load('organization'),
                    'subject_areas' => $subject_areas,
                    'selected_options' => $selected_options,
                ],201);
                
            }
            else{
                return response([
                    'message'=>'parameters not found'
                ],422);
            }
        }
        else
        {
            return response([
                'message'=>'Form not found',
            ],422);
        }
        
    }

    public function submit(Form $form)
    {
        $user = Auth::user()->id;
        $roles = Auth::user()->roles->pluck('id');

        if(isset($form))
        {
            if($roles->contains(6))
            {
                if($form->status == 1 && $form->is_verified == 1 && $form->is_audited == 1)
                {
                    $form->update([
                        
                        'final_verified' => 1,
                        'final_verified_by' => $user,
                        'final_verified_at' => Carbon::now()->toDateTimeString(),

                    ]);

                    return response(['message'=>'Form verified successfully'],200);
                }
                else
                {
                    return response(['message'=>'You are not allowed to verify this form']);
                }
            }
            elseif($roles->contains(4))
            {
                if($form->status == 1 && $form->is_verified == 1)
                {
                    $form->update([

                        'is_audited' => 1,
                        'audited_by' => $user,
                        'audited_at' => Carbon::now()->toDateTimeString(),

                    ]);

                    return response(['message'=>'Form audited successfully'],200);
                }
                else
                {
                    return response(['message'=>'You are not allowed to audit this form']);
                }
            }
            elseif($roles->contains(5))
            {
                if($form->status == 1)
                {
                    $form->update([

                        'is_verified' => 1,
                        'verified_by' => $user,
                        'verified_at' => Carbon::now()->toDateTimeString(),
                    ]);

                    return response(['message'=>'Form verified successfully'],200);
                }
                else
                {
                    return response(['message'=>'You are not allowed to verify this form']);
                }
            }
            elseif($roles->contains(2))
            {
                $form->update([

                    'status' => 1,
                    'user_id' => $user
                ]);
                
                return response(['message'=>'Form submitted successfully'],200);
            }
            else
            {
                return response(['message'=>'You are not allowed to verify this form']);
            }
        }
        else
        {

            return response(['message'=>'Form not found'],422);
        }    
    }

    public function show()
    {
        $forms = Auth::user()->forms()->get();
        return response()->json(['forms'=> $forms]);
    }

    public function feedback(Request $request)
    {
        // dd($request->feedbacks);
        $form = Form::findOrFail($request->form_id);

        if(isset($form))
        {
            $form_subject_area = FormSubjectArea::where('form_id',$request->form_id)->where('subject_area_id',$request->subject_area)->first();
            // dd($request->parameter['id']);
            $form_detail = FormDetail::where('form_subject_area_id',$form_subject_area->id)->where('parameter_id',$request->id)->first();
            // dd($form_detail);
            foreach($request->feedbacks as $feedback)
            {
                // dd($feedback);
                $feedback = Feedback::create([
                    'feedback' => $feedback['feedback'],
                    'user_id' => Auth::user()->id,
                    'form_detail_id' => $form_detail->id,
                    'status' => 1
                ]);

            }

            $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
            $selected_options = $this->selectedOptions($form);

            return response([
                'message'=>'Thank you for your feedback',
                'subject_areas' => $subject_areas,
                'selected_options' => $selected_options,
                'form_details' => $form->load('organization'),
            ],201);
        }
        else
        {
            return response([
                'message'=>'Form not found',
            ],422);
        }
    }

    public function feedbackStatus(Request $request, Feedback $feedback)
    {
        // dd($request->all());
        $form = Form::findOrFail($request->form_id);
        $feedback = Feedback::findOrFail($feedback->id);
        $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();

        
        if(isset($feedback))
        {
            if($feedback->user_id == Auth::user()->id)
            {
                $feedback->update([
                    'status'=>$request->status
                ]);

                $selected_options = $this->selectedOptions($form);
                

                return response(
                    [
                        'message' => 'Feedback status updated successfully',
                        'form_details' => $form->load('organization'),
                        'subject_areas' => $subject_areas,
                        'selected_options' => $selected_options,
                    ],200
                    );
            }
            else
            {
                return response([
                    'message' => "you are not allowed to change the status of this feedback"
                ]);
            }
        }
        else
        {
            return response([
                'message'=>'Feedback not found',
            ],422);
        }

    }

    public function reassign(Request $request, Form $form)
    {
        // dd($form);
        $user = Auth::user()->id;
        $roles = Auth::user()->roles->pluck('id');
        $form = Form::findOrFail($form->id);

        if(isset($form))
        {
            if($roles->contains(6))
            {
                $form->update([
                    'is_audited' => 0,
                    'final_verified_by' => $user
                ]);
                
                return response([
                    'message' => "Form reassigned successfully"
                ]);
            }
            elseif($roles->contains(5))
            {
                $form->update([

                    'status' => 0,
                    'verified_by' => $user
                ]);
                return response([
                    'message' => "Form reassigned successfully"
                ]);
            }
            elseif($roles->contains(4))
            {
                $form->update([

                    'is_verified' => 0,
                    'audited_by' => $user
                ]);
                return response([
                    'message' => "Form reassigned successfully"
                ]);
            }
            else{
                return response([
                    'message' => "You are not allowed to reassign the form"
                ]);
            }
        }
        else
        {
            return response([
                'message' => "Form not found"
            ],422);
        }
    }

    function selectedOptions($form)
    {
        $selected_subjectareas = $form->subjectAreas()->get();
        $selected_subjectareas_id = [];
        foreach($selected_subjectareas as $selected_subjectarea) {
            array_push($selected_subjectareas_id, $selected_subjectarea->pivot->id);

        }
        $selected_options = FormDetail::whereIn('form_subject_area_id', $selected_subjectareas_id)->with('feedbacks','selected_subjectarea')->get();
                
        return $selected_options;
    }
}
