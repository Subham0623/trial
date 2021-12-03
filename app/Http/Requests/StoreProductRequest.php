<?php

namespace App\Http\Requests;

use App\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'         => [
                'required'],
            // 'price'        => [
            //     'required'],
            // 'categories.*' => [
            //     'integer'],
            // 'categories'   => [
            //     'required',
            //     'array'],
            // 'tags.*'       => [
            //     'integer'],
            // 'tags'         => [
            //     'array'],
            // 'authors.*'       => [
            //         'integer'],
            // 'authors'         => [
            //         'array'],
            // 'book_id'          =>[
            //         'required'],
            // 'level_id'          =>[
            //     'required'],
            'slug'         => [
                'required',
                'unique:products'],
        ];

    }
}
