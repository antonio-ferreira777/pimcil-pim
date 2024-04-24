<?php

namespace App\Http\Requests;

use App\Models\FylesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFylesTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fyles_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:fyles_types,name,' . request()->route('fyles_type')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:fyles_types,slug,' . request()->route('fyles_type')->id,
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
