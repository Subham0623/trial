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
        $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
        return response(['subject_areas' => $subject_areas]);
    }

    public function store(Request $request)
    {
        dd($request->all());
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
