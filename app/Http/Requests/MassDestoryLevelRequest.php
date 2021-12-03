<?php

namespace App\Http\Requests;

use App\Level;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestoryLevelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:levels,id',
        ];

    }
}
