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
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    public function form()
    {
        $user = Auth::user()->load('forms.options');
        $selected_options = [];
        
        if($user->forms()->exists()) {
            $form = $user->forms()->latest()->first();
            $selected_options = $form->options()->pluck('option_id');
            
            // $subject_areas = SubjectArea::with(['parameters.options' => function ($query) use ($selected_options) {
            //     $query->find($selected_options)->each->setAttribute('status',true);
            //     $query->whereNotIn('id', $selected_options)->get()->each->setAttribute('status',false);
            // }])
            // ->get();
        }
        
        $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
        
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
        dd($request->all());
        $form = Form::findOrFail($request->id)->with('user')->first();
        dd($form);
        if(isset($form)){
            foreach($options as $option)
            {
                $data = [
                    $form_id = $form->id,
                    $option_id = $option->id,
                ];
                 
                $form_option = FormDetail::create($data);
            

            }
        }

        $data = [
            'user_id' => Auth::user()->id,
            // 'organization_id' => Auth::user()->organization()->id,
            'year' => $request->year,

        ];

        $form = Form::create($data);

        // $data = [
        //     'form_id' => $form->id,
        // ];
        return response(['message'=>'Form saved successfully']);
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
}
