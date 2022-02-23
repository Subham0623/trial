<?php

namespace App\Http\Requests;

use App\SubjectArea;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSubjectAreaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('subject_area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title' => [
                'required'],
            'slug' => [ 
                'required',
                'unique:subject_areas,slug,' . request()->route('subject_area')->id],
            'sort' => [ 
                'required'],    
        ];

    }
}
