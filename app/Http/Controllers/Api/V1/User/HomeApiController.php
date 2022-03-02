<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Auth;
use App\SubjectArea;
use App\Parameter;
use App\Option;
use App\Form;
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

    public function store(Request $request)
    {
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
}
