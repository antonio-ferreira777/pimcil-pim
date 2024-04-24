<?php

namespace App\Http\Requests;

use App\Models\EntitiesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEntitiesTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entities_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:entities_types,name,' . request()->route('entities_type')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:entities_types,slug,' . request()->route('entities_type')->id,
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
