<?php

namespace App\Http\Requests;

use App\Level;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLevelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title' => [
                'required'],
        ];

    }
}
