<?php

namespace App\Http\Requests;

use App\Book;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreBookRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title'         => [
                'required'],
            'book'        => [
                'required'],
        ];

    }
}
