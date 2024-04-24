<?php

namespace App\Http\Requests;

use App\Models\FylesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFylesTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fyles_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:fyles_types',
            ],
            'slug' => [
                'string',
                'required',
                'unique:fyles_types',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
