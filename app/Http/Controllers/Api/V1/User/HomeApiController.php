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
use App\Jobs\SendFormCreatedJob;
use App\Jobs\SendFormUpdatedJob;
use App\Jobs\SendFormVerifiedJob;
use App\Jobs\SendFormAudittedJob;
use App\Jobs\SendFormSubmittedJob;
use App\Document;


class HomeApiController extends Controller
{
    public function form()
    {
        $subject_areas = SubjectArea::active()->with('activeParameters.activeOptions','activeParameters.activeDocuments')->get();
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
    //    dd($request->all());
        $user = Auth::user();
        $roles = $user->roles()->pluck('id');
        $user_organization = $user->organizations->first();

        
        $forms = Form::where('year',$request->year)->pluck('organization_id');

        if($request->mode == 'options') {
            if(!$forms->contains($user_organization->id)) {
                $data = [
                    'user_id' => $user->id,
                    'year' => $request->year,
                    'organization_id' => $user_organization->id,
                ];

                $form = Form::create($data);
                
                $form_subject_area = FormSubjectArea::create([
                    'form_id' => $form->id,
                    'subject_area_id' => $request->subject_area,
                ]);
                if($request->parameters)
                {

                    foreach($request->parameters as $parameter )
                    {   
                        $max_points = Parameter::where('id',$parameter['id'])->first()->activeOptions()->max('points');
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
                                        'marksByVerifier' => ($roles->contains(5) ? $opt->points : ''),
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
                                'option_id' =>null,
                                'marks' => $max_points,
                                'marksByVerifier' => ($roles->contains(5) ? $max_points : ''),
                            ]);
                        }
                    }
                }
                
                $c1 = SubjectArea::where('id',$request->subject_area)->first()->activeParameters->count();
                $c2 = $form_subject_area->parameters->count();
                $total = $form_subject_area->parameters->sum('pivot.marks');
                $form_subject_area->update([
                    'marks'=> $total,
                    'status_verifier' => (($c1 == $c2) ? 1 : $form_subject_area->status_verifier),
                ]);

                $total_marks = $form->subjectAreas->sum('pivot.marks');
                $form->total_marks = $total_marks;
                $form->status = ($roles->contains(5) ? 1 : 0);
                $form->save();

                return response([
                    'message'=>'Form saved successfully'
                ],201);
            }
            else
            {
                return response([
                    'message'=> 'Your organization has already submitted the form'
                ]);
            }
        }

        if($request->mode == 'documents') {
            
            $form = Form::where('organization_id', $user_organization->id)->where('year', $request->year)->with('subjectAreas')->first();
            
            if($form) {
                if($request->documents) {
                    foreach($request->documents as $id => $document) {
                        $document_details = Document::find($id);
                        
                        $form_subject_area = $form->form_subjectareas()->whereHas('selected_subjectareas', function($query) use ($document_details) {
                                $query->where('parameter_id', $document_details->parameter_id);
                            })
                            ->with(['selected_subjectareas' => function($query) use ($document_details) {
                                $query->where('parameter_id', $document_details->parameter_id);
                            }])
                            ->first();
                            
                        if($form_subject_area) {
                            $filename = md5($document->getClientOriginalName()) . '.' . $document->getClientOriginalExtension();
                            // foreach($form_subject_area->selected_subjectareas as $subject_parameter) {
                                
                            //     $subject_parameter->addMedia($document)->setFileName($filename)->toMediaCollection('documents');
                            // }
                            $form_subject_area->selected_subjectareas->each(function ($subject_parameter) use ($document, $filename, $document_details) {
                                // foreach ($subject_parameter->documents as $media) {
                                //     dd($document->getClientOriginalName());
                                //     if (!in_array($media->file_name, $request->input('resource', []))) {
                                //         $media->delete();
                                //     }
                                // }
                                
                                $media = $subject_parameter->addMedia($document)->setFileName($filename)->toMediaCollection('documents');
                                $media->document_id = $document_details->id;
                                // $media->setCustomProperty('document_id',$document_details->id);
                                $media->save();
                            });
                        }
                    }

                }
                
                dispatch(new SendFormCreatedJob($form));

                return response([
                    'message'=>'Form saved successfully',
                    'form_id'=>$form->id
                ],201);

            } else {
                return response([
                    'message'=> 'Form not found',
                ]);
            }

        }

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
        // $subject_areas = SubjectArea::with(['activeParameters.activeOptions'=>function($query) use($form_option){
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
        // dd($form);
        $organizations = Organization::whereHas('users',function($query){
            $query->where('id',Auth::user()->id);
        })->pluck('id');

        $user = Auth::user();
        $roles = $user->roles->pluck('id');
        $selected_options = [];
        
        if($form) 
        {
            if($organizations->contains($form->organization_id))
            {
                $selected_options = $this->selectedOptions($form);
                
                $subject_areas = SubjectArea::active()->with('activeParameters.activeOptions','activeParameters.activeDocuments')->get();
                
                return response([
                    'subject_areas' => $subject_areas,
                    'selected_options' => $selected_options,
                    'form_details' => $form->load('organization','form_subjectareas'),
                ]);
            }
            elseif($roles->contains(2) || $roles->contains(1))
            {
                $selected_options = $this->selectedOptions($form);
                
                $subject_areas = SubjectArea::active()->with('activeParameters.activeOptions','activeParameters.activeDocuments')->get();

                return response([
                    'subject_areas' => $subject_areas,
                    'selected_options' => $selected_options,
                    'form_details' => $form->load('organization','form_subjectareas'),
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
        
        $subject_areas = SubjectArea::active()->with('activeParameters.activeOptions','activeParameters.activeDocuments')->get();
        

        $form = Form::findOrFail($form->id);
        
        // dd($form);
        if(isset($form)){
            if($request->mode == 'options') {
                $form_subject_area = FormSubjectArea::updateOrCreate([
                    'form_id' => $form->id,
                    'subject_area_id' => $request->subject_area,
                ]);
                // dd($form_subject_area);
                
                if($request->parameters)
                {
                    
                    foreach($request->parameters as $parameter )
                    {   
                        $max_points = Parameter::where('id',$parameter['id'])->first()->activeOptions()->max('points');
                        $form_detail = FormDetail::where('form_subject_area_id',$form_subject_area->id)->where('parameter_id',$parameter['id'])->first();
                        
                        if(isset($form_detail))
                        {
                            if($form_detail->is_applicable == $parameter['is_applicable'])
                            {

                                if($parameter['is_applicable'] == 0) //0 means applicable and 1 means not applicable
                                {
                                    if(isset($parameter['option']['id'])) {
                                        $opt = Option::findorFail($parameter['option']['id']);
                
                                        if($roles->contains(3) && ($user->id == $form->user_id) && ($form->status == 0 || $form->status == 2))
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
                                            if(($form->user_id == $user->id) )
                                            {
                                                if($form->is_verified == 0 || $form->is_verified == 2)
                                                {

                                                    $form_detail->update([
                                                        'remarks' => $parameter['remarks'],
                                                        'is_applicable' => $parameter['is_applicable'],
                                                        'option_id' => $opt->id,
                                                        'marksByVerifier' => $opt->points,
                                                        'marks' => $opt->points,
                                                    ]); 
                                                    $form->update([
                                                        'updated_by'=>$user->id,
                                                        'verified_by' => $user->id
                                                    ]);
                                                }
                                            }
                                            else
                                            {
                                                if($form->is_verified == 0 || $form->is_verified == 2)
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
                                            
                                        }
                                        elseif($roles->contains(4) && ($form->is_audited == 0 || $form->is_audited == 2) )
                                        {
                                            $form_detail->update([
                                                'option_id' => $opt->id,
                                                'marksByAuditor' => $opt->points,
                                                'reassign' => $parameter['reassign'],
                                            ]); 
                                            $form->update([
                                                'audited_by'=>$user->id,
                                                'is_verified' => ($parameter['reassign'] == 1 ? 2 : $form->is_verified),
                                            ]);
                                        }
                                        elseif($roles->contains(6) && $form->final_verified == 0)
                                        {
                                            $form_detail->update([
                                                'option_id' => $opt->id,
                                                'marksByFinalVerifier' => $opt->points,
                                                'reassign' => $parameter['reassign'],
                                            ]); 
                                            $form->update([
                                                'final_verified_by'=>$user->id,
                                                'is_audited' => ($parameter['reassign'] == 1 ? 2 : $form->is_audited),
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
                                    if($form->user_id == $user->id )
                                    {
                                        // dd($parameter);
                                        if($roles->contains(3) && (($form->status == 0) || $form->status == 2))
                                        {
                                            $form_detail = FormDetail::updateOrCreate([
                                                'form_subject_area_id' => $form_subject_area->id,
                                                'parameter_id' => $parameter['id'],
                                            ],
                                            [
                                                'remarks' => $parameter['remarks'],
                                                'option_id' => null,
                                                'marks' => $max_points,
                                                // 'marksByVerifier' => ($roles->contains(5) ? $max_points : ''),
                                                'is_applicable' => $parameter['is_applicable'],
                                            ]); 
                                            $form->update([
                                                'updated_by'=>$user->id,
                                                // 'verified_by' => ($roles->contains(5) ? $user->id : null)
                                            ]);
                                        }
                                        elseif(($form->is_verified == 0) || ($form->is_verified == 2))
                                        {

                                            $form_detail = FormDetail::updateOrCreate([
                                                'form_subject_area_id' => $form_subject_area->id,
                                                'parameter_id' => $parameter['id'],
                                            ],
                                            [
                                                'remarks' => $parameter['remarks'],
                                                'option_id' => null,
                                                'marks' => $max_points,
                                                'marksByVerifier' => ($roles->contains(5) ? $max_points : ''),
                                                'is_applicable' => $parameter['is_applicable'],
                                            ]); 
                                            $form->update([
                                                'updated_by'=>$user->id,
                                                'verified_by' => ($roles->contains(5) ? $user->id : null)
                                            ]);
                                        }
                                        else
                                        {
                                            return response(['message'=>'access denied'],403);
                                        }
                                        
                                    }
                                    else
                                    {
                                        if($roles->contains(4) && (($form->is_audited == 0) || ($form->is_audited == 2)))
                                            {
                                                $form_detail->update([
                                                    'reassign' => $parameter['reassign'],
                                                ]);
                                                $form->update([
                                                    'audited_by' => $user->id,
                                                    'is_verified' => ($parameter['reassign'] == 1 ? 2 : $form->is_verified),
                                                ]);
                                            }
                                            elseif($roles->contains(6) && $form->is_final_verified == 0)
                                            {
                                                $form_detail->update([
                                                    'reassign' => $parameter['reassign'],
                                                ]);
                                                $form->update([
                                                    'final_verified_by'=>$user->id,
                                                    'is_audited' => ($parameter['reassign'] == 1 ? 2 : $form->is_audited),
                                                ]);
                                            }
                                            else
                                            {
                                            
                                                return response(['message'=>'access denied'],403);
                                            }
                                        
                                    }
                                }
                            }
                            else
                            {
                                if($form->user_id == $user->id )
                                {
                                    if($parameter['is_applicable'] == 0)
                                    {
                                        if(isset($parameter['option']['id']))
                                        {
                                            $opt = Option::findorFail($parameter['option']['id']);
            
                                            if($roles->contains(3) && (($form->status == 0) || ($form->status == 2)))
                                            {
                                                $form_detail->update([
                                                    'remarks' => $parameter['remarks'],
                                                    'is_applicable' => $parameter['is_applicable'],
                                                    'option_id' => $opt->id,
                                                    // 'marksByVerifier' => ($roles->contains(5) ? $opt->id : ''),
                                                    'marks' => $opt->points,
                                                ]);
                                                $form->update([
                                                    'updated_by' => $user->id, 
                                                    // 'verified_by' => ($roles->contains(5) ? $user->id : null),
                                                ]);
                                            }
                                            elseif(($roles ->contains(5)) && (($form->is_verified ==0) || $form->is_verified == 2))
                                            {

                                                $form_detail->update([
                                                    'remarks' => $parameter['remarks'],
                                                    'is_applicable' => $parameter['is_applicable'],
                                                    'option_id' => $opt->id,
                                                    'marksByVerifier' => ($roles->contains(5) ? $opt->id : ''),
                                                    'marks' => $opt->points,
                                                ]);
                                                $form->update([
                                                    'updated_by' => $user->id, 
                                                    'verified_by' => ($roles->contains(5) ? $user->id : null),
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
                                        if($roles->contains(3) && (($form->status == 0) || ($form->status == 2)))
                                        {

                                            $form_detail->update([
                                                'remarks' => $parameter['remarks'],
                                                'option_id' => null,
                                                'marks' => $max_points,
                                                // 'marksByVerifier' => ($roles->contains(5) ? $max_points : ''),
                                                'is_applicable' => $parameter['is_applicable'],
                                            ]);
                                            $form->update([
                                                'updated_by' => $user->id, 
                                                // 'verified_by' => ($roles->contains(5) ? $user->id : null),
                                            ]);
                                        }
                                        elseif($roles->contains(5) && (($form->is_verified == 0) || ($form->is_verified == 2)))
                                        {
                                            $form_detail->update([
                                                'remarks' => $parameter['remarks'],
                                                'option_id' => null,
                                                'marks' => $max_points,
                                                'marksByVerifier' => ($roles->contains(5) ? $max_points : ''),
                                                'is_applicable' => $parameter['is_applicable'],
                                            ]);
                                            $form->update([
                                                'updated_by' => $user->id, 
                                                'verified_by' => ($roles->contains(5) ? $user->id : null),
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
                                    return response(['message'=>'access denied'],403);
                                }
                            }
                        }
                        else
                        {
                            if($form->user_id == $user->id )
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
                                            'marksByVerifier' => ($roles->contains(5) ? $opt->points : ''),
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
                                        'option_id' => null,
                                        'marks' => $max_points,
                                        'marksByVerifier' => ($roles->contains(5) ? $max_points : ''),
                                    ]);
                                }
                            }
                            else{
                                return response(['message'=>'access denied']);
                            }
                        }
                    }

                    $count = $form_subject_area->selected_subjectareas()->where('reassign',1)->count();
        
                    $c1 = SubjectArea::where('id',$request->subject_area)->first()->activeParameters->count();
                    $c2 = $form_subject_area->parameters->count();

                    $total = $form_subject_area->parameters->sum('pivot.marks');
                    $totalByVerifier = $form_subject_area->parameters->sum('pivot.marksByVerifier');
                    $totalByAuditor = $form_subject_area->parameters->sum('pivot.marksByAuditor');
                    $totalByFinalVerifier = $form_subject_area->parameters->sum('pivot.marksByFinalVerifier');
       
                    $form_subject_area->update([
                        'marks'=> $total,
                        'marksByVerifier'=> $totalByVerifier,
                        'marksByAuditor'=> $totalByAuditor,
                        'marksByFinalVerifier'=> $totalByFinalVerifier,
                        'status_verifier'=> ((($roles->contains(5)) && ($c1 == $c2)) ? 1 : $form_subject_area->status_verifier),
                        'status_auditor' => ($roles->contains(4) ? (($count>0)?2 : 1):$form_subject_area->status_auditor),
                        'status_final_verifier' => (($roles->contains(6) || $roles->contains(4)) ? (($count>0)?2 : 1): $form_subject_area->status_final_verifier),
                    ]);
                    
                    $total_marks = $form->form_subjectareas->sum('marks');
                    $total_marks_verifier = $form->form_subjectareas->sum('marksByVerifier');
                    $total_marks_auditor = $form->form_subjectareas->sum('marksByAuditor');
                    $total_marks_finalVerifier = $form->form_subjectareas->sum('marksByFinalVerifier');
        
                    $form->update([
                        'total_marks' => $total_marks,
                        'total_marks_verifier' => $total_marks_verifier,
                        'total_marks_auditor' => $total_marks_auditor,
                        'total_marks_finalVerifier' => $total_marks_finalVerifier,
                    ]);
        
                    return response([
                        'message'=>'Form updated successfully'
                    ],201);
                }
                else{
                    return response([
                        'message'=>'parameters not provided'
                    ],422);
                }
            } 

            if($request->mode == 'documents') {
                if($request->documents) {
                    foreach($request->documents as $id => $document) {
                        $document_details = Document::find($id);
                        
                        $form_subject_area = $form->form_subjectareas()->whereHas('selected_subjectareas', function($query) use ($document_details) {
                                $query->where('parameter_id', $document_details->parameter_id);
                            })
                            ->with(['selected_subjectareas' => function($query) use ($document_details) {
                                $query->where('parameter_id', $document_details->parameter_id);
                            }])
                            ->first();
                            
                        if($form_subject_area) {
                            $filename = md5($document->getClientOriginalName()) . '.' . $document->getClientOriginalExtension();
                            // dd($form_subject_area);
                            $form_subject_area->selected_subjectareas->each(function ($subject_parameter) use ($document, $filename, $document_details) {
                                
                                if (count($subject_parameter->documents) > 0) {
                                    foreach ($subject_parameter->documents as $media) {
                                        if($media->document_id == $document_details->id) {
                                            $media->delete();
                                        }
                                    }
                                }
    
                                $media = $subject_parameter->addMedia($document)->setFileName($filename)->toMediaCollection('documents');
                                $media->document_id = $document_details->id;
                                $media->save();
                            });
                        }
                    }

                }
                
                dispatch(new SendFormUpdatedJob($form));
                
                $selected_options = $this->selectedOptions($form);
                
                return response([
                    'message'=>'Form updated successfully',
                    'form_details' => $form->load('organization','form_subjectareas'),
                    'subject_areas' => $subject_areas,
                    'selected_options' => $selected_options,
                ],201);
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
        // dd($grades['grade']);
        if(isset($form))
        {
            
            if($roles->contains(6))
            {
                if($form->is_audited == 1 || $form->is_audited == 2)
                {
                    $grades = $this->grade($form);
                    $form->update([
                        
                        'final_verified' => 1,
                        'final_verified_by' => $user,
                        'final_verified_at' => Carbon::now()->toDateTimeString(),
                        'grade' => $grades['grade'],
                        'remarks' => $grades['remarks'],

                    ]);
                    dispatch(new SendFormVerifiedJob($form));
                    return response(['message'=>'Form verified successfully'],200);
                }
                else
                {
                    return response(['message'=>'You are not allowed to verify this form']);
                }
            }
            elseif($roles->contains(4))
            {
                if($form->is_verified == 1 || $form->is_verified == 2)
                {
                    $form->update([

                        'is_audited' => 1,
                        'audited_by' => $user,
                        'audited_at' => Carbon::now()->toDateTimeString(),

                    ]);
                    dispatch(new SendFormAudittedJob($form));
                    return response(['message'=>'Form audited successfully'],200);
                }
                else
                {
                    return response(['message'=>'You are not allowed to audit this form']);
                }
            }
            elseif($roles->contains(5))
            {
                if(($form->status == 1 || $form->status == 2) && ($form->user_id !== $user))
                {
                    $form->update([

                        'is_verified' => 1,
                        'verified_by' => $user,
                        'verified_at' => Carbon::now()->toDateTimeString(),
                    ]);
                    dispatch(new SendFormSubmittedJob($form));
                    return response(['message'=>'Form submitted successfully'],200);
                }
                elseif($form->user_id == $user)
                {
                    $form->update([
                        'status' => 1,
                        'user_id' => $user,
                        'is_verified' => 1,
                        'verified_by' => $user,
                        'verified_at' => Carbon::now()->toDateTimeString(),
                    ]);
                    dispatch(new SendFormSubmittedJob($form));
                    return response(['message'=>'Form submitted successfully'],200);
                }
                else
                {
                    return response(['message'=>'You are not allowed to verify this form']);
                }
            }
            elseif($roles->contains(3))
            {
                $form->update([

                    'status' => 1,
                    'user_id' => $user
                ]);
                dispatch(new SendFormSubmittedJob($form));
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
        $roles = Auth::user()->roles()->pluck('id');
        $orgs = Auth::user()->organizations()->pluck('id');

        if($roles->contains(5))
        {
            $verified_forms = Auth::user()->verifiedForms()->get();
            $forms = Form::whereIn('organization_id',$orgs)
            ->where('status',1)
            ->where('verified_by',NULL)->get();

            $forms = $forms->merge($verified_forms)->all();
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

            // dd($forms);

        }
        elseif($roles->contains(3))
        {
            $forms = Form::whereIn('organization_id',$orgs)->with('user')->get();
        }
        elseif($roles->contains(1) || $roles->contains(2))
        {
            $forms = Form::all();
        }
        else
        {
            $forms = [];
        }
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

            $subject_areas = SubjectArea::active()->with('activeParameters.activeOptions','activeParameters.activeDocuments')->get();
            $selected_options = $this->selectedOptions($form);

            return response([
                'message'=>'Thank you for your feedback',
                'subject_areas' => $subject_areas,
                'selected_options' => $selected_options,
                'form_details' => $form->load('organization','form_subjectareas'),
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
        $subject_areas = SubjectArea::active()->with('activeParameters.activeOptions','activeParameters.activeDocuments')->get();

        
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
                        'form_details' => $form->load('organization','form_subjectareas'),
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
            if($roles->contains(6) && $form->final_verified == 0)
            {
                $form->update([
                    'is_audited' => 0,
                    'final_verified_by' => $user
                ]);
                
                return response([
                    'message' => "Form reassigned successfully"
                ]);
            }
            elseif($roles->contains(5) && $form->is_verified == 0)
            {
                $form->update([

                    'status' => 0,
                    'verified_by' => $user
                ]);
                return response([
                    'message' => "Form reassigned successfully"
                ]);
            }
            elseif($roles->contains(4) && $form->is_audited == 0)
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
        $selected_options = FormDetail::whereIn('form_subject_area_id', $selected_subjectareas_id)->with('feedbacks','feedbacks.user','feedbacks.user.roles','selected_subjectarea','media')->get();
                
        return $selected_options;
    }

    public function grade($form)
    {
        // dd($user,$roles,$form);
        
        if(isset($form))
        {
            // dd($form->total_marks_finalVerifier);
            if($form->total_marks_finalVerifier >= 90)
            {
                return ['grade'=>"A+",'remarks'=>'अति उत्कृष्ट'];
            }
            elseif(($form->total_marks_finalVerifier >=75) && ($form->total_marks_finalVerifier < 90))
            {
                return ['grade'=>"A",'remarks'=>'उत्कृष्ट'];
            }
            elseif(($form->total_marks_finalVerifier >= 60) && ($form->total_marks_finalVerifier < 75))
            {
                return ['grade'=>"B+",'remarks'=>'राम्रो'];
            }
            elseif(($form->total_marks_finalVerifier >= 45) && ($form->total_marks_finalVerifier < 60))
            {
                return ['grade'=>"B",'remarks'=>'सन्तोषजनक'];
            }
            elseif(($form->total_marks_finalVerifier >= 30) && ($form->total_marks_finalVerifier < 45))
            {
                return ['grade'=>"C+",'remarks'=>'कमजोर'];
            }
            else
            {
                return ['grade'=>"C",'remarks'=>"खराब"];
            }
        }
        
    }
}
