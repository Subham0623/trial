<?php

namespace App\Http\Requests;

use App\Organization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganizationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('organization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name' => [
                'required'],
            'slug' => [ 
                'required',
                'unique:organizations,slug,' . request()->route('organization')->id], 
        ];

    }
}
