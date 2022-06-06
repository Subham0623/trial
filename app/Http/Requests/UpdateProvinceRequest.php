<?php

namespace App\Http\Requests;

use App\Province;
use App\District;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;


class UpdateProvinceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('province_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules(Request $request)
    {
         $rules = [
            'name' => [
                'required',
            'unique:provinces,name,' . request()->route('province')->id],
            // 'addmore.*.name' => ['required'],

        ];
        // dd($request->addmore);
        // here loop through the staff array to add the ignore
        foreach($request->addmore as $key => $item) {
            // dd($item['name']);
            $district = District::where('name',$item['name'])->first();
            // dd($district);
            if ($district !== NULL) { // if have an id, means an update, so add the id to ignore
                $rules = array_merge($rules, ['addmore.'.$key.'.name' => ['unique:districts,name,'.$district->id]],);
            }
            else
            {
                $rules = array_merge($rules, ['addmore.'.$key.'.name' => ['unique:districts,name']]);
            }
        }
// dd($rules);
         return $rules;
    }
}
